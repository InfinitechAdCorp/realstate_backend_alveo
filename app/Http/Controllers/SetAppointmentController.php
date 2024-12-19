<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentAccepted;
use App\Models\SetAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SetAppointmentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'datetime' => 'required|string',
            'email' => 'required|email',
            'number' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
            'property' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        // Add default status
        $validated['status'] = 'PENDING';

        // Create the appointment
        $appointment = SetAppointment::create($validated);

        // Check if the creation was successful
        if ($appointment) {
            return response()->json([
                'message' => 'Appointment scheduled successfully!',
                'appointment' => $appointment
            ], 201); // Return a 201 (Created) status
        } else {
            return response()->json([
                'message' => 'Appointment failed to schedule!',
            ], 500); // Return a 500 (Internal Server Error) status
        }
    }

    public function getAll()
    {
        $appointments = SetAppointment::all();

        return response()->json($appointments);
    }

    public function accept($id)
    {
        $appointments = SetAppointment::where('id', $id)->where('status', "PENDING")->first();

        if ($appointments) {
            // Update the status to 'ACCEPTED'
            $appointments->status = "ACCEPTED";
            $appointments->save();

            // Send email to the user after updating the appointment
            Mail::to($appointments->email)->send(new AppointmentAccepted($appointments));

            return response()->json([
                'message' => 'Appointment accepted successfully!',
            ], 200);
        } else {
            return response()->json(
                ["message" => 'Failed to update',],
                500
            );
        }
    }
    public function decline($id)
    {
        $appointments = SetAppointment::where('id', $id)->where('status', "ACCEPTED")->first();
        if ($appointments) {
            $appointments->status = "DECLINED";
            $appointments->save();
            return response()->json([
                'message' => 'Appointment declined successfully!',
            ], 200);
        } else {
            return response()->json(
                ["message" => 'Failed to update',],
                500
            );
        }
    }
}

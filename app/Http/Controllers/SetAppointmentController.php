<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentAccepted;
use App\Mail\AppointmentDeclined;
use App\Models\SetAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

    public function accept(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|string|in:ACCEPTED,DECLINED',
        ]);

        $id = $request->id;  // Get the ID from the request body
        $status = $request->status; // Get the status from the request

        Log::info($request->all());
        // Find the appointment with the specified ID
        $appointment = SetAppointment::find($id);

        if ($appointment) {
            if ($status === 'ACCEPTED') {
                if ($appointment->status !== 'PENDING') {
                    return response()->json([
                        'message' => 'Appointment must be in PENDING status to accept.',
                    ], 400); // If the appointment is not PENDING, reject the action
                }
                $appointment->status = 'ACCEPTED';
                $appointment->save();

                // Send an email to the user after updating the appointment
                Mail::to($appointment->email)->send(new AppointmentAccepted($appointment));

                return response()->json([
                    'message' => 'Appointment accepted successfully!',
                ], 200);
            }

            if ($status === 'DECLINED') {
                if ($appointment->status !== 'PENDING') {
                    return response()->json([
                        'message' => 'Appointment must be in PENDING status to decline.',
                    ], 400); // If the appointment is not PENDING, reject the action
                }
                $appointment->status = 'DECLINED';
                $appointment->save();

                Mail::to($appointment->email)->send(new AppointmentDeclined($appointment));

                return response()->json([
                    'message' => 'Appointment declined successfully!',
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Appointment not found.',
        ], 404);
    }
}

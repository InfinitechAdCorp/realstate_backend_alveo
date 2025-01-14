<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentAccepted;
use App\Mail\AppointmentDeclined;
use App\Models\SetAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SetAppointmentController extends Controller
{
    public function countRequestViewing()
{
    $requestViewing = SetAppointment::where('reason', 'Request Viewing') // Filter by reason
        ->groupBy('property') // Group by property
        ->select('property', \DB::raw('count(*) as total')) // Count the number of requests per property
        ->get();

    return response()->json($requestViewing); // Return JSON response
}

public function countPropertyInquiry()
{
    $propertyInquiry = SetAppointment::where('reason', 'Property Inquiry') // Filter by reason
        ->groupBy('property') // Group by property
        ->select('property', \DB::raw('count(*) as total')) // Count the number of requests per property
        ->get();

    return response()->json($propertyInquiry); // Return JSON response
}

public function request(Request $request)
{
    // Log incoming request (optional for debugging)
    \Log::info('Appointment Request:', $request->all());

    try {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'appointmentDate' => 'required|date', // Ensure it's a valid date
            'unit' => 'required|string|max:255',
            'reason' => 'required|string|max:255'
        ]);

        // Store the appointment
        $appointment = SetAppointment::create([
            'fullname' => $request->name,  // Ensure 'fullname' is set
            'email' => $request->email,
            'number' => $request->phone,
            'datetime' => \Carbon\Carbon::parse($request->appointmentDate), // Convert to DateTime
            'reason' => $request->reason,
            'property' => $request->unit,  // Save unit as 'property'
            'message' => $request->message,
            'status' => 'PENDING'
        ]);

        // Return success response
        return response()->json([
            'message' => 'Appointment saved successfully',
            'appointment' => $appointment,
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Catch validation errors and return them
        return response()->json([
            'error' => 'Validation failed',
            'message' => $e->errors(),
        ], 422);
    }
}





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

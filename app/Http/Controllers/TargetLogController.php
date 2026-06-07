<?php

namespace App\Http\Controllers;

use App\Models\Target;
use App\Models\TargetLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class TargetLogController extends Controller
{
    /**
     * Store a newly created log entry in storage.
     */
    public function store(Request $request, string $targetId)
    {
        $user = Auth::user();
        $target = $user->targets()->findOrFail($targetId);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:increase,decrease',
            'description' => 'nullable|string|max:255',
            'log_date' => 'required|date',
        ]);

        try {
            \DB::beginTransaction();

            // Create the log entry
            $log = new TargetLog($validated);
            $log->target_id = $target->id;
            $log->user_id = $user->id;
            $log->save();

            // Update the target's current amount
            if ($validated['type'] === 'increase') {
                $target->current_amount += $validated['amount'];
            } else {
                $target->current_amount -= $validated['amount'];
            }

            // Ensure current amount doesn't go below 0
            if ($target->current_amount < 0) {
                $target->current_amount = 0;
            }

            // If current amount reaches target amount, we could auto-complete it, 
            // but let's keep it simple for now as per user request.
            
            $target->save();

            \DB::commit();

            return back()->with('success', 'Savings log updated successfully!');
        } catch (Throwable $e) {
            \DB::rollBack();
            \Log::error('Failed to save target log', [
                'target_id' => $targetId,
                'user_id' => $user->id,
                'message' => $e->getMessage(),
            ]);

            return back()->withErrors(['error' => 'Failed to update savings log.']);
        }
    }

    /**
     * Remove the specified log entry from storage.
     */
    public function destroy(string $targetId, string $logId)
    {
        $user = Auth::user();
        $target = $user->targets()->findOrFail($targetId);
        $log = $target->logs()->where('user_id', $user->id)->findOrFail($logId);

        try {
            \DB::beginTransaction();

            // Revert the amount from the target
            if ($log->type === 'increase') {
                $target->current_amount -= $log->amount;
            } else {
                $target->current_amount += $log->amount;
            }

            if ($target->current_amount < 0) {
                $target->current_amount = 0;
            }

            $target->save();
            $log->delete();

            \DB::commit();

            return back()->with('success', 'Log entry deleted successfully!');
        } catch (Throwable $e) {
            \DB::rollBack();
            return back()->withErrors(['error' => 'Failed to delete log entry.']);
        }
    }
}

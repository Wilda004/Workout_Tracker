<?php

require_once __DIR__ . '/../Models/Workout.php';
require_once __DIR__ . '/../Traits/ResponseTrait.php';

class WorkoutController {
    use ResponseTrait;

    // Mendapatkan semua workout
    public function getAllWorkouts() {
        $workoutModel = new Workout();
        $workouts = $workoutModel->findAll();

        return $this->respondSuccess("Workouts retrieved", $workouts);
    }

    // Menambahkan workout baru
    public function addWorkout($data) {
        $workoutModel = new Workout();

        if (isset($data['name']) && isset($data['duration'])) {
            if ($workoutModel->create($data)) {
                return $this->respondSuccess("Workout created successfully");
            }
        }

        return $this->respondError("Failed to create workout");
    }

    // Memperbarui workout
    public function updateWorkout($id, $data) {
        $workoutModel = new Workout();

        if (isset($data['name']) && isset($data['duration'])) {
            if ($workoutModel->update($id, $data)) {
                return $this->respondSuccess("Workout updated successfully");
            }
        }

        return $this->respondError("Failed to update workout");
    }

    // Menghapus workout
    public function deleteWorkout($id) {
        $workoutModel = new Workout();

        if ($workoutModel->delete($id)) {
            return $this->respondSuccess("Workout deleted successfully");
        }

        return $this->respondError("Failed to delete workout");
    }
}

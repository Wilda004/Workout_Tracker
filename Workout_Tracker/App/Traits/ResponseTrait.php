<?php

trait ResponseTrait {
    // Response sukses
    public function respondSuccess($message, $data = []) {
        return json_encode(["status" => "success", "message" => $message, "data" => $data]);
    }

    // Response error
    public function respondError($message) {
        return json_encode(["status" => "error", "message" => $message]);
    }
}

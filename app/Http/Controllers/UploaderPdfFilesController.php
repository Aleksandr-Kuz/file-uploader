<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Services\FileUploader;


class UploaderPdfFilesController extends BaseController
{
    /**
     * @param Request $request
     * @return string
     */
    public function upload(Request $request): string {

        $validator = Validator::make($request->all(), $this->getValidationRules());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $urlUploadedFiles  = [];
        foreach ($request->file() as $key => $file) {
            $urlUploadedFiles[$key] = FileUploader::upload($file);
        }

        return response()->json($urlUploadedFiles);
    }

    /**
     * @return string[]
     */
    protected function getValidationRules(): array {
        return ['*' => 'bail|required|file|max:10000|mimes:pdf'];
    }
}

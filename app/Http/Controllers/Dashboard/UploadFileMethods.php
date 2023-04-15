<?php

namespace App\Http\Controllers\Dashboard;

use App\DataImporters\DataImporter;
use App\Http\Requests\UploadFileRequest;
use App\Novostruev\ExcelParser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

trait UploadFileMethods
{
    public static string $msgSuccess = 'Данные были успешно импортированы';
    public static string $msgError = 'Файл не загружен';

    /**
     * @return Application|Factory|View
     */
    public function uploadForm(Request $request): Factory|View|Application
    {
        return view($this->getUploadViewName());
    }

    /**
     * @param UploadFileRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function uploadFile(UploadFileRequest $request): RedirectResponse
    {
        $this->authorize($this->abilities->import());

        $file = $this->getFileFromRequest($request);
        if (!$file) {
            return back()->withErrors(self::$msgError);
        }

        $filename       = $this->getUploadedFilename($file);
        $data           = $this->getImportedData($filename);
        $dataImporter   = $this->getDataImporter();

        $dataImporter->import($data);

        $errors = $dataImporter->getErrors();
        if ($errors) {
            return back()->withErrors($errors);
        }
        return back()->with(['success' => self::$msgSuccess]);
    }

    /**
     * @return DataImporter
     */
    abstract protected function getDataImporter(): DataImporter;

    /**
     * @param UploadedFile|UploadedFile[] $file
     * @return string
     */
    protected function getUploadedFilename($file): string
    {
        $location = $this->getLocation();
        $filename = $this->getFilename($file);

        return $file->move($location, $filename);
    }

    /**
     * @param string $filename
     * @return array
     */
    protected function getImportedData(string $filename): array
    {
        return ExcelParser::parse($filename);
    }

    /**
     * @param Request $request
     * @return array|UploadedFile|null
     */
    private function getFileFromRequest(Request $request): array|UploadedFile|null
    {
        return $request->file('file');
    }

    /**
     * @param array|UploadedFile|UploadedFile[]|null $file
     * @return string
     */
    private function getFilename($file): string
    {
        return time() . '_' . $file->getClientOriginalName();
    }

    /**
     * File upload location
     *
     * @return string
     */
    private function getLocation(): string
    {
        return public_path('uploads');
    }
}

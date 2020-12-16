<?php


namespace App\Validators;

use Upload\Validation\Size;

class FileSizeValidator extends Size
{
    public function __construct($maxSize, $minSize = 0, $message = null)
    {
        parent::__construct($maxSize, $minSize);

        $this->setMessage($message);
    }

    /**
     * Проверка на соответсвие веса файла
     * @param \Upload\File $file
     * @return bool
     */
    public function validate(\Upload\File $file): bool
    {
        $fileSize = $file->getSize();
        $isValid = true;

        if ($fileSize < $this->minSize) {
            if ($this->message === null) {
                $this->setMessage('Размер файла меньше чем '.humanFilesize($fileSize, 0));
            }
            $isValid = false;
        }

        if ($fileSize > $this->maxSize) {
            if ($this->message === null) {
                $this->setMessage('Размер файла больше чем '.humanFilesize($fileSize, 0));
            }
            $isValid = false;
        }

        return $isValid;
    }
}

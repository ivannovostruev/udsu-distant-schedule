<?php

namespace App\Utilities;

class LessonStatusRadioButton
{
    private int $code;
    private string $name;
    private string $shortname;
    private string $class;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setCode($data);
        $this->setName($data);
        $this->setShortname($data);
        $this->setClass($data);
    }

    /**
     * @param array $data
     */
    public function setCode(array $data): void
    {
        $this->code = $data['code'];
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param array $data
     */
    public function setName(array $data): void
    {
        $this->name = $data['name'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param array $data
     */
    public function setShortname(array $data): void
    {
        $this->shortname = $data['shortname'];
    }

    /**
     * @return string
     */
    public function getShortname(): string
    {
        return $this->shortname;
    }

    /**
     * @param array $data
     */
    public function setClass(array $data): void
    {
        $this->class = $data['class'];
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }
}

<?php

namespace App\Models\Schedule\Cells;

class LessonCell extends Cell
{
    private LessonCellDecorator $lessonCellDecorator;

    public function __construct($data)
    {
        parent::__construct($data);

        $this->lessonCellDecorator = new LessonCellDecorator($this->data);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->data->name;
    }

    /**
     * @return string
     */
    public function getBackgroundColor(): string
    {
        return $this->lessonCellDecorator->getBackgroundColor();
    }

    /**
     * @return string
     */
    public function getTextColorCssClass(): string
    {
        return $this->lessonCellDecorator->getTextColorCssClass();
    }

    /**
     * @return string
     */
    public function getCrossOutTextCssClass(): string
    {
        return $this->lessonCellDecorator->getCrossOutTextCssClass();
    }

    /**
     * @return string
     */
    public function getCssClasses(): string
    {
        return $this->lessonCellDecorator->getCssClasses();
    }

    /**
     * @return bool
     */
    public function isShouldRecord(): bool
    {
        return $this->data->isShouldRecord();
    }

    /**
     * @return bool
     */
    public function linkTypeIsIndividual(): bool
    {
        return $this->data->linkTypeIsIndividual();
    }
}

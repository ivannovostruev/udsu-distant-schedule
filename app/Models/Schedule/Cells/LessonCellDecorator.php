<?php

namespace App\Models\Schedule\Cells;

use App\Models\Schedule\LessonStatus;
use App\Utilities\ColorHelper;
use App\Models\Schedule\Lesson;

class LessonCellDecorator
{
    const TEXT_DARK_CSS_CLASS       = 'text-dark';
    const TEXT_LIGHT_CSS_CLASS      = 'text-light';
    const TEXT_CROSS_OUT_CSS_CLASS  = 'text-cross-out';

    private ?string $cellColor = null;
    private ?string $crossOutTextCssClass = null;

    public function __construct(Lesson $lesson)
    {
        $this->setCellColor($lesson);
        $this->setCrossOutTextCssClass($lesson);
    }

    /**
     * @param Lesson $lesson
     */
    private function setCellColor(Lesson $lesson): void
    {
        if (isset($lesson->color_id)) {
            $this->cellColor = $lesson->color->hex;
        } else {
            $this->cellColor = $this->getDefaultCellColor($lesson);
        }
    }

    /**
     * @param Lesson $lesson
     * @return string|null
     */
    private function getDefaultCellColor(Lesson $lesson): ?string
    {
        return DefaultCellColors::determine($lesson);
    }

    /**
     * @param Lesson $lesson
     */
    public function setCrossOutTextCssClass(Lesson $lesson): void
    {
        if ($lesson->status == LessonStatus::CANCELED) {
            $this->crossOutTextCssClass = self::TEXT_CROSS_OUT_CSS_CLASS;
        }
    }

    /**
     * @return string
     */
    public function getTextColorCssClass(): string
    {
        if (is_null($this->cellColor)) {
            return '';
        }

        return ColorHelper::determineColorTone($this->cellColor)
            ? self::TEXT_DARK_CSS_CLASS
            : self::TEXT_LIGHT_CSS_CLASS;
    }

    /**
     * @return string
     */
    public function getBackgroundColor(): string
    {
        return $this->cellColor ?? '';
    }

    /**
     * @return string
     */
    public function getCrossOutTextCssClass(): string
    {
        return $this->crossOutTextCssClass ?? '';
    }

    /**
     * @return string
     */
    public function getCssClasses(): string
    {
        $classes = [];
        if ($this->getTextColorCssClass()) {
            $classes[] = $this->getTextColorCssClass();
        }
        if ($this->getCrossOutTextCssClass()) {
            $classes[] = $this->getCrossOutTextCssClass();
        }
        return implode(' ', $classes);
    }
}

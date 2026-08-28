<?php

namespace App\View\Components;

use App\Models\Testimonial as TestimonialModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Testimonial extends Component
{
    public $testimonials;
    public $row1;
    public $row2;
    public $count;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->testimonials = TestimonialModel::where(function($query) {
                $query->whereNull('video_url')->orWhere('video_url', '');
            })
            ->latest()
            ->get();
        $this->count = $this->testimonials->count();

        if ($this->count > 0) {
            // Group by row
            $row1 = TestimonialModel::where('row', 1)
                ->where(function($query) {
                    $query->whereNull('video_url')->orWhere('video_url', '');
                })
                ->latest()
                ->get();
            $row2 = TestimonialModel::where('row', 2)
                ->where(function($query) {
                    $query->whereNull('video_url')->orWhere('video_url', '');
                })
                ->latest()
                ->get();

            // Fallback: If both rows are empty (e.g. invalid database state), split all in half
            if ($row1->isEmpty() && $row2->isEmpty()) {
                $half = ceil($this->count / 2);
                $row1 = $this->testimonials->take($half);
                $row2 = $this->testimonials->skip($half);
            } 
            // If row 1 is empty, borrow from row 2
            elseif ($row1->isEmpty()) {
                $half = ceil($row2->count() / 2);
                $row1 = $row2->take($half);
                $row2 = $row2->skip($half);
            } 
            // If row 2 is empty, borrow from row 1
            elseif ($row2->isEmpty()) {
                $half = ceil($row1->count() / 2);
                $row2 = $row1->skip($half);
                $row1 = $row1->take($half);
            }

            // Pad each collection individually to ensure smooth marquee loop
            // Each row needs at least 4 items to loop seamlessly
            if ($row1->count() > 0) {
                while ($row1->count() < 4) {
                    $row1 = $row1->concat($row1);
                }
            }
            if ($row2->count() > 0) {
                while ($row2->count() < 4) {
                    $row2 = $row2->concat($row2);
                }
            }

            $this->row1 = $row1;
            $this->row2 = $row2;
        } else {
            $this->row1 = collect();
            $this->row2 = collect();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.testimonial');
    }
}

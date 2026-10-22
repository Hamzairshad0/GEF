<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Support\Uploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeroSlideController extends Controller
{
    public function index(): View
    {
        return view('admin.slides.index', ['slides' => HeroSlide::orderBy('sort')->get()]);
    }

    public function create(): View
    {
        return view('admin.slides.form', ['slide' => new HeroSlide(['is_active' => true, 'sort' => HeroSlide::max('sort') + 1])]);
    }

    public function store(Request $request): RedirectResponse
    {
        HeroSlide::create($this->validated($request, true));

        return redirect()->route('admin.slides.index')->with('success', 'Slide added.');
    }

    public function edit(HeroSlide $slide): View
    {
        return view('admin.slides.form', compact('slide'));
    }

    public function update(Request $request, HeroSlide $slide): RedirectResponse
    {
        $slide->update($this->validated($request, false));

        return redirect()->route('admin.slides.index')->with('success', 'Slide updated.');
    }

    public function destroy(HeroSlide $slide): RedirectResponse
    {
        $slide->delete();

        return back()->with('success', 'Slide removed.');
    }

    private function validated(Request $request, bool $creating): array
    {
        $data = $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:120'],
            'title' => ['required', 'string', 'max:160'],
            'subtitle' => ['nullable', 'string', 'max:400'],
            'cta_label' => ['nullable', 'string', 'max:60'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'sort' => ['nullable', 'integer', 'min:0'],
            'image_file' => [$creating ? 'required' : 'nullable', 'image', 'max:6144'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $data['sort'] ??= 0;
        if ($request->hasFile('image_file')) {
            $data['image'] = Uploads::store($request->file('image_file'));
        }
        unset($data['image_file']);

        return $data;
    }
}

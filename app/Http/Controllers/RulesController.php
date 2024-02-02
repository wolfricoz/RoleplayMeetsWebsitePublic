<?php

namespace App\Http\Controllers;

use App\Models\Rules;
use App\Support\Helpers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RulesController extends Controller
{
    public function admin()
    {

        return view('admin.rules.index', [
            'rules' => Rules::get()->sortBy('position'),
        ]);

    }

    public function index()
    {

        return view('rules', [
            'rules' => Rules::get()->sortBy('position')
        ]);

    }

    public function store(Request $request): RedirectResponse
    {
      $rule = $request->validate([
        'title' => 'required',
        'content' => 'required',
      ]);
      $rule['content'] = trim(Helpers::trim_extra_spaces($request['content']));
      $rule['position'] = Rules::count() + 1;

      Rules::create($rule);

      return redirect()->back()->with('success', "Rule {$request['title']} successfully created.");
    }

    public function update(Request $request, Rules $rule): RedirectResponse
    {
      if ($request->has('up')){
        $rule->moveOrderUp();
        return redirect()->back()->with('success', "Rule $rule->title successfully moved up.");
      }
      if ($request->has('down')){
        $rule->moveOrderDown();
        return redirect()->back()->with('success', "Rule $rule->title successfully moved down.");
      }

      $rule->update([
        'title' => $request->title,
        'content' => trim(Helpers::trim_extra_spaces($request['content'])),
      ]);

      return redirect()->back()->with('success', "Rule {$request['title']} successfully updated.");
    }


    public function destroy(Rules $rule): RedirectResponse
    {

      $rule->delete();
      $rules = Rules::all()->sortBy('position');
      $position = 1;
      foreach ($rules as $r){
        $r->update([
          'position' => $position,
        ]);
        $position++;
      }
      return redirect()->back()->with('success', "Rule $rule->title successfully deleted.");
    }
}

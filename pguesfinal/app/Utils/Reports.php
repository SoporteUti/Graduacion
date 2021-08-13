<?php
namespace App\Utils;

use Jimmyjs\ReportGenerator\Facades\PdfReportFacade;

use App\Provider;
use App\Report;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Reports{


	public function displayReport(Report $request) {
	    // Retrieve any filters
	    // 
	    // dd($request);
	    $queryBuilder=Provider::select(['name','email','phone','status'])->orderBy($request->sortBy);

	   return PdfReportFacade::of($request->title, $request->meta, $queryBuilder, $request->columns)
	    ->setCss([
          '.head-content' => 'border-width: 1px',
   		])->setPaper('a4')->make()->download('providers.pdf');

   		

   		//dd($pdf);

	}
}
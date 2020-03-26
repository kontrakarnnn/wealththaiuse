<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendEmailTest;
use Mail;
use App\Jobs\QueueJobs;
use App\Cases;
use App\Jobs\AddRenewCaseJobs;
class Renewcases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Renewcases:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This laravel cronjob is used to Renew Case';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixedphp
     */
    public function handle()
    {
      $day = date("d");
      $month = date("m");
      $year = date("Y");
      $currentdate = $year.$month.$day;
    //  $array= array();
      $case = Cases::with(['Person','Stage','Cases','Block','Partner_block','CaseType','CaseSubType','Asset','match_id','CaseStatus','coordiantor','CaseChannel'])->whereNotNull('auto_renew_date')->whereNull('renew_case_id')->where('case_status',2)->get();
      foreach($case as $ca)
      {
        $explode = explode('/',$ca->auto_renew_date);
        $dayre = $explode[0];
        $monthre = $explode[1];
        $yearre = $explode[2]-543;
        $renewdate = $yearre.$monthre.$dayre;

        if(($renewdate-$currentdate) == $ca->CaseType->day_auto_renew)
        {
           $caseid = $ca->id;
           dispatch(new AddRenewCaseJobs($caseid))->delay(now()->addMinutes(1));
           echo "Send Success";
           $input = [
             'renew_case_id' => $case->id,
           ];
           Cases::where('id', $ca->id)
               ->update($input);
        }
        else
        {
          echo "Nothing to Run";
        }
      }
    }
}

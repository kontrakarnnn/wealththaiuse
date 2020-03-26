<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\SendEmailTest;
use Mail;
use App\Cases;
use App\CaseAuth;

class AddRenewCaseJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $caseid;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($caseid)
    {
        //
         $this->caseid = $caseid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //dd($this->caseid);
        //

        $fromcase = Cases::find($this->caseid);
        if($fromcase->renew_case_id == NULL)
        {

        $case = New Cases;
        $case->name = $fromcase->name;
        $case->type_id = $fromcase->type_id;
        $case->sub_type_id =  $fromcase->sub_type_id;
        $case->created_by_pid = $fromcase->created_by_pid;
        $case->procedure_id	 = $fromcase->procedure_id;
        $case->stage =  $fromcase->stage;
        $case->referal_asset = $fromcase->referal_asset;
        $case->ref_previous_case = $fromcase->id;
        //$case->ref_name = $refname;
        $case->note_from_partner =  $fromcase->note_from_partner;
        $case->note_from_user =  $fromcase->note_from_user;
        $case->note_from_member =  $fromcase->note_from_member;
        $case->note_from_previous_case = $fromcase->note_to_copy_to_renew_case;
        $case->case_channel = $fromcase->case_channel;
        $case->case_status = 1;
        $case->member_case_owner = $fromcase->member_case_owner;
        $case->consult_partner_block_id = $fromcase->consult_partner_block_id;
        $case->service_user_block_id = $fromcase->service_user_block_id;
        $case->coordinate_user_block_id = $fromcase->coordinate_user_block_id;
        $case->case_created_date = $fromcase->case_created_date;
        //$case->auto_renew_date = '';
        //$case->next_notify_date = '';
        $case->require_value1 = $fromcase->require_value1;
        $case->require_value2 = $fromcase->require_value2;
        $case->require_value3 = $fromcase->require_value3;
        $case->require_value4 = $fromcase->require_value4;
        $case->require_value5 = $fromcase->require_value5;
        $case->require_value6 = $fromcase->require_value6;
        $case->require_value7 = $fromcase->var_value51;
        $case->require_value8 = $fromcase->var_value52;
        $case->require_value9 = $fromcase->var_value53;
        $case->require_value10 = $fromcase->require_value10;
        $case->require_value11 = $fromcase->require_value11;
        $case->require_value12 = $fromcase->require_value12;
        $case->require_value13 = $fromcase->require_value13;
        $case->require_value14 = $fromcase->require_value14;
        $case->require_value15 = $fromcase->require_value15;
        $case->require_value16 = $fromcase->require_value16;
        $case->require_value17 = $fromcase->require_value17;
        $case->require_value18 = $fromcase->require_value18;
        $case->require_value19 = $fromcase->require_value19;
        $case->require_value20 = $fromcase->require_value20;
        $case->save();
        $input = [
          'renew_case_id' => $case->id,
        ];
        Cases::where('id', $fromcase->id)
            ->update($input);
        $getoldcaseauth = CaseAuth::where('case_id',$fromcase->id)->get();
        foreach($getoldcaseauth as $getold)
        {
          $caseauth = New CaseAuth;
          $caseauth->case_id = $case->id;
          $caseauth->public_id = $getold->public_id;
          $caseauth->block_partner = $getold->block_partner;
          $caseauth->block_user = $getold->block_user;
          $caseauth->guild_member = $getold->guild_member;
          $caseauth->group_member = $getold->group_member;
          $caseauth->group_pid = $getold->group_pid;
          $caseauth->group_partner = $getold->group_partner;
          $caseauth->save();
        }

      }
      else
      {

      }
    }
}

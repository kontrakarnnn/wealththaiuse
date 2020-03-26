<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Structure;
use Illuminate\Support\Facades\Auth;
use App\Block;
use App\View;
use App\Asset_cat;
use App\OfferCategory;
use App\Cases;
use App\Procedures;
use App\Process;
use App\Stage;
use App\Path;
use App\Path_condition;
use App\Path_condition_detail;
use App\Condition;
use App\FileCat;
use App\Asset;
use App\File;
use App\Portfolio;
use App\Asset_Attacht;
use App\Member_Attacht;
use App\Case_Attacht;
use App\Offer_Attacht;
use App\CaseAction;
use App\StageAction;
use App\Action;
use App\Case_condition;
use App\match_id;
use App\Case_log;
use App\Procedures_To_Process;
use App\Casemiddledata;
use App\Proposal;
use App\Offer;
use App\OfferType;
use App\Asset_Transaction;

use App\Http\Controllers\SidebarController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\NotiCenterController;
use App\Http\Controllers\DataController;

class CaseCenterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function putpathconincasecon($caseid)
    {
        date_default_timezone_set('Asia/Bangkok');
        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        $date = $day.'/'.$month.'/'.$year;
        $time = date('H:i:s');
        $case = Cases::where('id', $caseid)->get();
        $findcasefinish = Cases::where('id', $caseid)->where('case_status',1)->value('stage');
        $findcasefinishdate = Cases::where('id', $caseid)->value('finish_date');
        if ($findcasefinish == 42) {
            $input = ['finish_date' => date($date)];
            Cases::where('id', $caseid)
              ->update($input);
        }
        //return $case;
        foreach ($case as $ca) {
            $caseowner = $ca->member_case_owner;
            $proceduretoprocess = Procedures_To_Process::where('procedure_id', $ca->procedure_id)->get();
            foreach ($proceduretoprocess as $pro) {
                if ($pro->start_process_flag == 1) {
                    $process = Process::where('id', $pro->process_id)->get();

                    foreach ($process as $proc) {

                        $startstage = Stage::where('id', $proc->start_stage)->get();

                        if ($ca->stage == null || $ca->stage == 0 || $ca->stage == '') {
                            $input = ['stage' => $proc->start_stage];
                            Cases::where('id', $ca->id)
                  ->update($input);
                        }
                        foreach ($startstage as $start) {
                            if ($start->end_stage_flag == 1) {
                                return 'Endstage';
                            } else {
                                //  $path = Path::where('from_stage',$start->id)->orderBy('path_priority','DESC')->take(1)->get();

                                $path = Path::where('from_stage', $start->id)->get();
                                foreach ($path as $pa) {
                                    if ($pa->path_connection == 1) { //ใช้falseวิ่ง
                                    } else {
                                        $pathcondition = Path_condition::where('path_id', $pa->id)->get();
                                        foreach ($pathcondition as $pathcon) {
                                            if ($pathcon->reverse_all_preposition == 1) {
                                            } else {
                                                if ($pathcon->reverse_each_preposition1 == 1) {
                                                } else {
                                                    if ($pathcon->path_condition_detail1 == null) {
                                                    } else {
                                                        $caseconditionfind = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail1)->get();
                                                        if (count($caseconditionfind)>0) {
                                                            $pathcondition = Path_condition_detail::where('id', $pathcon->path_condition_detail1)->get();
                                                            foreach ($pathcondition as $path) {
                                                                if ($path->condition_id == 8) {
                                                                }
                                                            }
                                                        } else {
                                                            $casecondition = new Case_condition;
                                                            $casecondition->name = "";
                                                            $casecondition->case_id = $ca->id;
                                                            $casecondition->condition_flag = 0;
                                                            $casecondition->current_stage = $start->id;
                                                            $casecondition->date_time =  $date." ".$time;
                                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail1;
                                                            $casecondition->save();
                                                        }
                                                    }
                                                }
                                                if ($pathcon->reverse_each_preposition2 == 1) {
                                                } else {
                                                    if ($pathcon->path_condition_detail2 == null) {
                                                    } else {
                                                        $caseconditionfind = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail2)->get();
                                                        if (count($caseconditionfind)>0) {
                                                        } else {
                                                            $casecondition = new Case_condition;
                                                            $casecondition->name = "";
                                                            $casecondition->case_id = $ca->id;
                                                            $casecondition->condition_flag = 0;
                                                            $casecondition->current_stage = $start->id;
                                                            $casecondition->date_time =  $date." ".$time;
                                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail2;
                                                            $casecondition->save();
                                                        }
                                                    }
                                                }
                                                if ($pathcon->reverse_each_preposition3 == 1) {
                                                } else {
                                                    if ($pathcon->path_condition_detail3 == null) {
                                                    } else {
                                                        $caseconditionfind = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail3)->get();
                                                        if (count($caseconditionfind)>0) {
                                                        } else {
                                                            $casecondition = new Case_condition;
                                                            $casecondition->name = "";
                                                            $casecondition->case_id = $ca->id;
                                                            $casecondition->condition_flag = 0;
                                                            $casecondition->current_stage = $start->id;
                                                            $casecondition->date_time =  $date." ".$time;
                                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail3;
                                                            $casecondition->save();
                                                        }
                                                    }
                                                }
                                                if ($pathcon->reverse_each_preposition4 == 1) {
                                                } else {
                                                    if ($pathcon->path_condition_detail4 == null) {
                                                    } else {
                                                        $caseconditionfind = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail4)->get();
                                                        if (count($caseconditionfind)>0) {
                                                        } else {
                                                            $casecondition = new Case_condition;
                                                            $casecondition->name = "";
                                                            $casecondition->case_id = $ca->id;
                                                            $casecondition->condition_flag = 0;
                                                            $casecondition->current_stage = $start->id;
                                                            $casecondition->date_time =  $date." ".$time;
                                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail4;
                                                            $casecondition->save();
                                                        }
                                                    }
                                                }
                                                if ($pathcon->reverse_each_preposition5 == 1) {
                                                } else {
                                                    if ($pathcon->path_condition_detail5 == null) {
                                                    } else {
                                                        $caseconditionfind = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail5)->get();
                                                        if (count($caseconditionfind)>0) {
                                                        } else {
                                                            $casecondition = new Case_condition;
                                                            $casecondition->name = "";
                                                            $casecondition->case_id = $ca->id;
                                                            $casecondition->condition_flag = 0;
                                                            $casecondition->current_stage = $start->id;
                                                            $casecondition->date_time =  $date." ".$time;
                                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail5;
                                                            $casecondition->save();
                                                        }
                                                    }
                                                }
                                                if ($pathcon->reverse_each_preposition6 == 1) {
                                                } else {
                                                    if ($pathcon->path_condition_detail6 == null) {
                                                    } else {
                                                        $caseconditionfind = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail6)->get();
                                                        if (count($caseconditionfind)>0) {
                                                        } else {
                                                            $casecondition = new Case_condition;
                                                            $casecondition->name = "";
                                                            $casecondition->case_id = $ca->id;
                                                            $casecondition->condition_flag = 0;
                                                            $casecondition->current_stage = $start->id;
                                                            $casecondition->date_time =  $date." ".$time;
                                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail6;
                                                            $casecondition->save();
                                                        }
                                                    }
                                                }
                                                if ($pathcon->reverse_each_preposition7 == 1) {
                                                } else {
                                                    if ($pathcon->path_condition_detail7 == null) {
                                                    } else {
                                                        $caseconditionfind = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail7)->get();
                                                        if (count($caseconditionfind)>0) {
                                                        } else {
                                                            $casecondition = new Case_condition;
                                                            $casecondition->name = "";
                                                            $casecondition->case_id = $ca->id;
                                                            $casecondition->condition_flag = 0;
                                                            $casecondition->current_stage = $start->id;
                                                            $casecondition->date_time =  $date." ".$time;
                                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail7;
                                                            $casecondition->save();
                                                        }
                                                    }
                                                }
                                                if ($pathcon->reverse_each_preposition8 == 1) {
                                                } else {
                                                    if ($pathcon->path_condition_detail8 == null) {
                                                    } else {
                                                        $caseconditionfind = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail8)->get();
                                                        if (count($caseconditionfind)>0) {
                                                        } else {
                                                            $casecondition = new Case_condition;
                                                            $casecondition->name = "";
                                                            $casecondition->case_id = $ca->id;
                                                            $casecondition->condition_flag = 0;
                                                            $casecondition->current_stage = $start->id;
                                                            $casecondition->date_time =  $date." ".$time;
                                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail8;
                                                            $casecondition->save();
                                                        }
                                                    }
                                                }
                                                if ($pathcon->reverse_each_preposition9 == 1) {
                                                } else {
                                                    if ($pathcon->path_condition_detail9 == null) {
                                                    } else {
                                                        $caseconditionfind = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail9)->get();
                                                        if (count($caseconditionfind)>0) {
                                                        } else {
                                                            $casecondition = new Case_condition;
                                                            $casecondition->name = "";
                                                            $casecondition->case_id = $ca->id;
                                                            $casecondition->condition_flag = 0;
                                                            $casecondition->current_stage = $start->id;
                                                            $casecondition->date_time =  $date." ".$time;
                                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail9;
                                                            $casecondition->save();
                                                        }
                                                    }
                                                }
                                                if ($pathcon->reverse_each_preposition10 == 1) {
                                                } else {
                                                    if ($pathcon->path_condition_detail10 == null) {
                                                    } else {
                                                        $caseconditionfind = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail10)->get();
                                                        if (count($caseconditionfind)>0) {
                                                        } else {
                                                            $casecondition = new Case_condition;
                                                            $casecondition->name = "";
                                                            $casecondition->case_id = $ca->id;
                                                            $casecondition->condition_flag = 0;
                                                            $casecondition->current_stage = $start->id;
                                                            $casecondition->date_time =  $date." ".$time;
                                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail10;
                                                            $casecondition->save();
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        //return $pathcondition;
                                    }
                                }
                            }
                        }
                        //return $startstage;
                    }
                } else {
                }
            }
        }
        //$this->putpathconincasecon();
    }
    public function nextcasecondition($tostage, $caseid)
    {
        date_default_timezone_set('Asia/Bangkok');
        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        $date = $day.'/'.$month.'/'.$year;
        $time = date('H:i:s');
        //  $currentstage = Cases::where('id',$caseid)->value('stage');
        $startstage = Stage::where('id', $tostage)->get();
        $findcasevalue = Cases::where('id', $caseid)->value('var_value130');


        if ($findcasevalue == 1) {
            $tostage = 31;
        }

        $input = ['stage' => $tostage];

        Cases::where('id', $caseid)
                          ->update($input);

        foreach ($startstage as $start) {
            if ($start->end_stage_flag == 1) {
                return 'Endstage';
            } else {
                $path = Path::where('from_stage', $start->id)->orderBy('path_priority', 'DESC')->take(1)->get();
                //  $path = Path::where('from_stage',$start->id)->get();
                foreach ($path as $pa) {
                    if ($pa->path_connection == 1) { //ใช้falseวิ่ง
                    } else {
                        $pathcondition = Path_condition::where('path_id', $pa->id)->get();
                        foreach ($pathcondition as $pathcon) {
                            if ($pathcon->reverse_all_preposition == 1) {
                            } else {
                                    if ($pathcon->path_condition_detail1 == null) {
                                    } else {
                                        $caseconditionfind = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathcon->path_condition_detail1)->get();
                                        if (count($caseconditionfind)>0) {
                                        } else {
                                            $casecondition = new Case_condition;
                                            $casecondition->name = "";
                                            $casecondition->case_id =$caseid;
                                            $casecondition->condition_flag = 0;
                                            $casecondition->current_stage = $start->id;
                                            $casecondition->date_time = $date." ".$time;
                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail1;
                                            $casecondition->save();
                                        }
                                    }

                                    if ($pathcon->path_condition_detail2 == null) {
                                    } else {
                                        $caseconditionfind = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathcon->path_condition_detail2)->get();
                                        if (count($caseconditionfind)>0) {
                                        } else {
                                            $casecondition = new Case_condition;
                                            $casecondition->name = "";
                                            $casecondition->case_id =$caseid;
                                            $casecondition->condition_flag = 0;
                                            $casecondition->current_stage = $start->id;
                                            $casecondition->date_time = $date." ".$time;
                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail2;
                                            $casecondition->save();
                                        }
                                    }
                                    if ($pathcon->path_condition_detail3 == null) {
                                    } else {
                                        $caseconditionfind = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathcon->path_condition_detail3)->get();
                                        if (count($caseconditionfind)>0) {
                                        } else {
                                            $casecondition = new Case_condition;
                                            $casecondition->name = "";
                                            $casecondition->case_id =$caseid;
                                            $casecondition->condition_flag = 0;
                                            $casecondition->current_stage = $start->id;
                                            $casecondition->date_time = $date." ".$time;
                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail3;
                                            $casecondition->save();
                                        }
                                    }
                                    if ($pathcon->path_condition_detail4 == null) {
                                    } else {
                                        $caseconditionfind = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathcon->path_condition_detail4)->get();
                                        if (count($caseconditionfind)>0) {
                                        } else {
                                            $casecondition = new Case_condition;
                                            $casecondition->name = "";
                                            $casecondition->case_id =$caseid;
                                            $casecondition->condition_flag = 0;
                                            $casecondition->current_stage = $start->id;
                                            $casecondition->date_time = $date." ".$time;
                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail4;
                                            $casecondition->save();
                                        }
                                    }
                                    if ($pathcon->path_condition_detail5 == null) {
                                    } else {
                                        $caseconditionfind = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathcon->path_condition_detail5)->get();
                                        if (count($caseconditionfind)>0) {
                                        } else {
                                            $casecondition = new Case_condition;
                                            $casecondition->name = "";
                                            $casecondition->case_id =$caseid;
                                            $casecondition->condition_flag = 0;
                                            $casecondition->current_stage = $start->id;
                                            $casecondition->date_time = $date." ".$time;
                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail5;
                                            $casecondition->save();
                                        }
                                    }

                                    if ($pathcon->path_condition_detail6 == null) {
                                    } else {
                                        $caseconditionfind = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathcon->path_condition_detail6)->get();
                                        if (count($caseconditionfind)>0) {
                                        } else {
                                            $casecondition = new Case_condition;
                                            $casecondition->name = "";
                                            $casecondition->case_id =$caseid;
                                            $casecondition->condition_flag = 0;
                                            $casecondition->current_stage = $start->id;
                                            $casecondition->date_time = $date." ".$time;
                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail6;
                                            $casecondition->save();
                                        }
                                    }

                                    if ($pathcon->path_condition_detail7 == null) {
                                    } else {
                                        $caseconditionfind = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathcon->path_condition_detail7)->get();
                                        if (count($caseconditionfind)>0) {
                                        } else {
                                            $casecondition = new Case_condition;
                                            $casecondition->name = "";
                                            $casecondition->case_id =$caseid;
                                            $casecondition->condition_flag = 0;
                                            $casecondition->current_stage = $start->id;
                                            $casecondition->date_time = $date." ".$time;
                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail7;
                                            $casecondition->save();
                                        }
                                    }

                                    if ($pathcon->path_condition_detail8 == null) {
                                    } else {
                                        $caseconditionfind = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathcon->path_condition_detail8)->get();
                                        if (count($caseconditionfind)>0) {
                                        } else {
                                            $casecondition = new Case_condition;
                                            $casecondition->name = "";
                                            $casecondition->case_id =$caseid;
                                            $casecondition->condition_flag = 0;
                                            $casecondition->current_stage = $start->id;
                                            $casecondition->date_time = $date." ".$time;
                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail8;
                                            $casecondition->save();
                                        }
                                    }

                                    if ($pathcon->path_condition_detail9 == null) {
                                    } else {
                                        $caseconditionfind = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathcon->path_condition_detail9)->get();
                                        if (count($caseconditionfind)>0) {
                                        } else {
                                            $casecondition = new Case_condition;
                                            $casecondition->name = "";
                                            $casecondition->case_id =$caseid;
                                            $casecondition->condition_flag = 0;
                                            $casecondition->current_stage = $start->id;
                                            $casecondition->date_time = $date." ".$time;
                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail9;
                                            $casecondition->save();
                                        }
                                    }

                                    if ($pathcon->path_condition_detail10 == null) {
                                    } else {
                                        $caseconditionfind = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathcon->path_condition_detail10)->get();
                                        if (count($caseconditionfind)>0) {
                                        } else {
                                            $casecondition = new Case_condition;
                                            $casecondition->name = "";
                                            $casecondition->case_id =$caseid;
                                            $casecondition->condition_flag = 0;
                                            $casecondition->current_stage = $start->id;
                                            $casecondition->date_time = $date." ".$time;
                                            $casecondition->path_condition_detail = $pathcon->path_condition_detail10;
                                            $casecondition->save();
                                        }
                                    }

                            }
                        }
                        //return $pathcondition;
                    }
                }
            }
        }
        //$this->putpathconincasecon();
    }
    public function checkcondition($caseid)
    {
        $caseidforcheck = Cases::where('id', $caseid)->where('case_status', 1)->value('id');

        $casecurrentstage = Cases::where('id', $caseid)->value('stage');
        //$casecondition = Case_condition::where('condition_flag',0)->where('path_condition_detail',61)->where('current_stage',$casecurrentstage)->get();
        $casecondition = Case_condition::where('condition_flag', 0)->where('case_id', $caseidforcheck)->where('current_stage', $casecurrentstage)->get();
        foreach ($casecondition as $casecon) {
            $path = Path::where('id', $casecon->path_condition_detail)->get();
            $pathcondition = Path_condition_detail::where('id', $casecon->path_condition_detail)->get();

            foreach ($pathcondition as $pathcon) {
                if ($pathcon->condition_id == 8) {
                    $caseowner = Cases::where('id', $casecon->case_id)->value('member_case_owner');
                    $filecatgroup = $pathcon->con_para_value1;
                    $filecat = $pathcon->con_para_value2;
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->recheckfile($caseowner, $filecat, $pathconid, $caseid, $filecatgroup);
                }
                if ($pathcon->condition_id == 9) {
                    $caseowner = Cases::where('id', $casecon->case_id)->value('created_by_pid');
                    $approveflag = $pathcon->con_para_value2;
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->approvecreator($caseowner, $approveflag, $pathconid, $caseid);
                }
                if ($pathcon->condition_id == 10) {
                    $caseowner = Cases::where('id', $casecon->case_id)->value('member_case_owner');
                    $approveflag = $pathcon->con_para_value2;
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    $this->approvecaseowner($caseowner, $approveflag, $pathconid, $caseid);
                }
                if ($pathcon->condition_id == 11) {
                    $caseowner = Cases::where('id', $casecon->case_id)->value('consult_partner_block_id');
                    $approveflag = $pathcon->con_para_value2;
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->approveconsultpartner($caseowner, $approveflag, $pathconid, $caseid);
                }
                if ($pathcon->condition_id == 12) {
                    $caseowner = Cases::where('id', $casecon->case_id)->value('service_user_block_id');
                    $approveflag = $pathcon->con_para_value2;
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->approveserviceuser($caseowner, $approveflag, $pathconid, $caseid);
                }
                if ($pathcon->condition_id == 13) {
                    $caseowner = Cases::where('id', $casecon->case_id)->value('coordinate_user_block_id');
                    $approveflag = $pathcon->con_para_value2;
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->approvecoordinate($caseowner, $approveflag, $pathconid, $caseid);
                }
                if ($pathcon->condition_id == 14) {
                    $caseowner = $pathcon->con_para_value1;
                    $approveflag = $pathcon->con_para_value2;
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->approvespecific($caseowner, $approveflag, $pathconid, $caseid);
                }
                if ($pathcon->condition_id == 15) {
                    $caseowner = $pathcon->con_para_value1;
                    $approveflag = $pathcon->con_para_value2;
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->approveguildofmember($caseowner, $approveflag, $pathconid, $caseid);
                }
                if ($pathcon->condition_id == 16) {
                    $caseowner = $pathcon->con_para_value1;
                    $approveflag = $pathcon->con_para_value2;
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->approvegrouppartner($caseowner, $approveflag, $pathconid, $caseid);
                }
                if ($pathcon->condition_id == 17) {
                    $caseowner = $pathcon->con_para_value1;
                    $approveflag = $pathcon->con_para_value2;
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->approvegrouppid($caseowner, $approveflag, $pathconid, $caseid);
                }
                if ($pathcon->condition_id == 18) {
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->casevaluenotnull($pathconid, $caseid);
                }
                //hasoffercondition
                if ($pathcon->condition_id == 19) {
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->hasproposal($pathconid, $caseid);
                }
                if ($pathcon->condition_id == 20) {
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->haspartnerproposal($pathconid, $caseid);
                }
                if ($pathcon->condition_id == 21) {
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->hasuserproposal($pathconid, $caseid);
                }
                if ($pathcon->condition_id == 22) {
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->hasmemberproposal($pathconid, $caseid);
                }
                if ($pathcon->condition_id == 23) {
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->hasoffer($pathconid, $caseid);
                }
                if ($pathcon->condition_id == 24) {
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->haspartneroffer($pathconid, $caseid);
                }
                if ($pathcon->condition_id == 25) {
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->hasuseroffer($pathconid, $caseid);
                }
                if ($pathcon->condition_id == 26) {
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->hasmemberoffer($pathconid, $caseid);
                }
                //hasoffercondition
                //conditionalwaytrue
                if ($pathcon->condition_id == 27) {
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    $this->alwaytrue($pathconid, $caseid);
                }
                if ($pathcon->condition_id == 28) {
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;
                    //return $filecat;
                    $this->hasconfirmoffer($pathconid, $caseid);
                }
                if ($pathcon->condition_id == 30) {
                    $pathconid = $casecon->path_condition_detail;
                    $caseid = $casecon->case_id;

                    $this->comparecasevalue($pathconid, $caseid);
                }
                //conditionalwaytrue
            }
        }

        //  return $casecondition;
    }
    public function hasconfirmoffer($pathconid, $caseid)
    {
        $casemiddledata = Casemiddledata::where('case_id', $caseid)->get();
        if (count($casemiddledata) >= 1) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
        ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function alwaytrue($pathconid, $caseid)
    {
        $input = ['condition_flag' => 1];
        $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
        ->update($input);
        return $this->checkcondition($caseid);
    }
    public function hasmemberoffer($pathconid, $caseid)
    {
        $pathconnumberofoffer = Path_condition_detail::where('id', $pathconid)->value('con_para_value2');
        if ($pathconnumberofoffer == null ||$pathconnumberofoffer == 0) {
            $pathconnumberofoffer = 1;
        }
        $checkcaseproposal = Proposal::where('case_id', $caseid)->whereNotNull('member_id')->pluck('id')->toArray();
        $checkcaseoffer = Offer::whereIn('proposal_id', $checkcaseproposal)->get();
        if (count($checkcaseoffer) >= $pathconnumberofoffer) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
        ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function hasuseroffer($pathconid, $caseid)
    {
        $pathconnumberofoffer = Path_condition_detail::where('id', $pathconid)->value('con_para_value2');
        if ($pathconnumberofoffer == null ||$pathconnumberofoffer == 0) {
            $pathconnumberofoffer = 1;
        }
        $checkcaseproposal = Proposal::where('case_id', $caseid)->whereNotNull('user_block')->pluck('id')->toArray();
        $checkcaseoffer = Offer::whereIn('proposal_id', $checkcaseproposal)->get();
        if (count($checkcaseoffer) >= $pathconnumberofoffer) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
        ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function haspartneroffer($pathconid, $caseid)
    {
        $pathconnumberofoffer = Path_condition_detail::where('id', $pathconid)->value('con_para_value2');
        if ($pathconnumberofoffer == null ||$pathconnumberofoffer == 0) {
            $pathconnumberofoffer = 1;
        }
        $checkcaseproposal = Proposal::where('case_id', $caseid)->whereNotNull('partner_block')->pluck('id')->toArray();
        $checkcaseoffer = Offer::whereIn('proposal_id', $checkcaseproposal)->get();
        if (count($checkcaseoffer) >= $pathconnumberofoffer) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
        ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function hasoffer($pathconid, $caseid)
    {
        $pathconnumberofoffer = Path_condition_detail::where('id', $pathconid)->value('con_para_value2');
        if ($pathconnumberofoffer == null ||$pathconnumberofoffer == 0) {
            $pathconnumberofoffer = 1;
        }
        $checkcaseproposal = Proposal::where('case_id', $caseid)->pluck('id')->toArray();
        $checkcaseoffer = Offer::whereIn('proposal_id', $checkcaseproposal)->get();
        if (count($checkcaseoffer) >= $pathconnumberofoffer) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
        ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function hasmemberproposal($pathconid, $caseid)
    {
        $pathconnumberofproposal = Path_condition_detail::where('id', $pathconid)->value('con_para_value2');
        if ($pathconnumberofproposal == null ||$pathconnumberofproposal == 0) {
            $pathconnumberofproposal = 1;
        }
        $checkcaseproposalmember = Proposal::where('case_id', $caseid)->whereNotNull('member_id')->get();
        if (count($checkcaseproposalmember) >= $pathconnumberofproposal) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
        ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function hasuserproposal($pathconid, $caseid)
    {
        $pathconnumberofproposal = Path_condition_detail::where('id', $pathconid)->value('con_para_value2');
        if ($pathconnumberofproposal == null ||$pathconnumberofproposal == 0) {
            $pathconnumberofproposal = 1;
        }
        $checkcaseproposaluser = Proposal::where('case_id', $caseid)->whereNotNull('user_block')->get();
        if (count($checkcaseproposaluser) >= $pathconnumberofproposal) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
        ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function haspartnerproposal($pathconid, $caseid)
    {
        $pathconnumberofproposal = Path_condition_detail::where('id', $pathconid)->value('con_para_value2');
        if ($pathconnumberofproposal == null ||$pathconnumberofproposal == 0) {
            $pathconnumberofproposal = 1;
        }
        $checkcaseproposalpartner = Proposal::where('case_id', $caseid)->whereNotNull('partnerblock')->get();
        if (count($checkcaseproposalpartner) >= $pathconnumberofproposal) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
        ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function hasproposal($pathconid, $caseid)
    {
        $pathconnumberofproposal = Path_condition_detail::where('id', $pathconid)->value('con_para_value2');
        if ($pathconnumberofproposal == null ||$pathconnumberofproposal == 0) {
            $pathconnumberofproposal = 1;
        }
        $checkcaseproposal = Proposal::where('case_id', $caseid)->get();
        if (count($checkcaseproposal) >= $pathconnumberofproposal) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
        ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function casevaluenotnull($pathconid, $caseid)
    {
        $pathcon = Path_condition_detail::where('id', $pathconid)->value('con_para_value1');
        $case = Cases::where('id', $caseid)->value('var_value'.$pathcon);
        if ($case == null) {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        } else {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
            return $this->checkcondition($caseid);
        }
    }
    public function comparecasevalue($pathconid, $caseid)
    {
        $pathcon = Path_condition_detail::where('id', $pathconid)->value('con_para_value1');
        $pathconsymbol = Path_condition_detail::where('id', $pathconid)->value('con_para_value2');
        $pathconvaluetocompare = Path_condition_detail::where('id', $pathconid)->value('con_para_value3');
        $case = Cases::where('id', $caseid)->value('var_value'.$pathcon);
        if ($case == null || $case == '') {
            $case = 0;
        }
        if ($pathconsymbol == '=') {
            $case = "'".$case."'";
            $pathconvaluetocompare = "'".$pathconvaluetocompare."'";
            $this->conditioncomparevalueequal($caseid, $pathconid, $pathconvaluetocompare, $case);
        } elseif ($pathconsymbol == '!=') {
            $case = "'".$case."'";
            $pathconvaluetocompare = "'".$pathconvaluetocompare."'";
            $this->conditioncomparevaluenotequal($caseid, $pathconid, $pathconvaluetocompare, $case);
        } elseif ($pathconsymbol == '>') {
            $this->conditioncomparevaluemorethan($caseid, $pathconid, $pathconvaluetocompare, $case);
        } elseif ($pathconsymbol == '<') {
            $this->conditioncomparevaluelowerthan($caseid, $pathconid, $pathconvaluetocompare, $case);
        } elseif ($pathconsymbol == '<=') {
            $this->conditioncomparevaluelowerthanorequal($caseid, $pathconid, $pathconvaluetocompare, $case);
        } elseif ($pathconsymbol == '>=') {
            $this->conditioncomparevaluemorethanorequal($caseid, $pathconid, $pathconvaluetocompare, $case);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function approvecaseowner($caseowner, $approveflag, $pathconid, $caseid)
    {
        if ($approveflag == 0) {
            $approveflag = 'no';
            return [$approveflag,$caseowner,$pathconid,$caseid];
        } else {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function approvecreator($caseowner, $approveflag, $pathconid, $caseid)
    {
        if ($approveflag == 0) {
            $approveflag = 'no';
            return [$approveflag,$caseowner,$pathconid,$caseid];
        } else {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function approveconsultpartner($caseowner, $approveflag, $pathconid, $caseid)
    {
        if ($approveflag == 0) {
            $approveflag = 'no';
            return [$approveflag,$caseowner,$pathconid,$caseid];
        } else {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function approveserviceuser($caseowner, $approveflag, $pathconid, $caseid)
    {
        if ($approveflag == 0) {
            $approveflag = 'no';
            return [$approveflag,$caseowner,$pathconid,$caseid];
        } else {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function approvecoordinate($caseowner, $approveflag, $pathconid, $caseid)
    {
        if ($approveflag == 0) {
            $approveflag = 'no';
            return [$approveflag,$caseowner,$pathconid,$caseid];
        } else {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function approvespecific($caseowner, $approveflag, $pathconid, $caseid)
    {
        if ($approveflag == 0) {
            $approveflag = 'no';
            return [$approveflag,$caseowner,$pathconid,$caseid];
        } else {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function approveguildofmember($caseowner, $approveflag, $pathconid, $caseid)
    {
        if ($approveflag == 0) {
            $approveflag = 'no';
            return [$approveflag,$caseowner,$pathconid,$caseid];
        } else {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function approvegrouppartner($caseowner, $approveflag, $pathconid, $caseid)
    {
        if ($approveflag == 0) {
            $approveflag = 'no';
            return [$approveflag,$caseowner,$pathconid,$caseid];
        } else {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function approvegrouppid($caseowner, $approveflag, $pathconid, $caseid)
    {
        if ($approveflag == 0) {
            $approveflag = 'no';
            return [$approveflag,$caseowner,$pathconid,$caseid];
        } else {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function recheckfile($caseowner, $filecat, $pathconid, $caseid, $filecatgroup)
    {
        if ($filecatgroup == 3) {
            $memberattacht = Member_Attacht::where('member_id', $caseowner)->pluck('file_id')->toArray();

            $memberfile = File::whereIn('id', $memberattacht)->where('file_cat_id', $filecat)->where('status', "Active")->get();
            //return $memberattacht;
            if (count($memberfile) >0) {
                $input = ['condition_flag' => 1];
                $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
                return $this->checkcondition($caseid);
            } else {
                $input = ['condition_flag' => 0];
                $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
              ->update($input);
                //return $this->checkcondition($caseid);
            }
        } elseif ($filecatgroup == 2) {
            $portid = Portfolio::where('member_id', $caseowner)->pluck('id')->toArray();
            $assetid = Asset::whereIn('port_id', $portid)->pluck('id')->toArray();
            $assetattacht = Asset_Attacht::whereIn('asset_id', $assetid)->pluck('file_id')->toArray();

            $assetfile = File::whereIn('id', $assetattacht)->where('file_cat_id', $filecat)->where('status', "Active")->get();
            if (count($assetfile) >0) {
                $input = ['condition_flag' => 1];
                $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
                return $this->checkcondition($caseid);
            } else {
                $input = ['condition_flag' => 0];
                $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
              ->update($input);
                //return $this->checkcondition($caseid);
            }
        } elseif ($filecatgroup == 1) {
            $portid1 = Portfolio::where('member_id', $caseowner)->pluck('file_port_ref1')->toArray();
            $portid2 = Portfolio::where('member_id', $caseowner)->pluck('file_port_ref2')->toArray();
            $portid3 = Portfolio::where('member_id', $caseowner)->pluck('file_port_ref3')->toArray();
            $filterport1 = array_filter($portid1);
            $filterport2 = array_filter($portid2);
            $filterport3 = array_filter($portid3);
            $fileport = array_merge($filterport1, $filterport2, $filterport3);
            $portfile = File::whereIn('id', $fileport)->where('file_cat_id', $filecat)->where('status', "Active")->get();
            if (count($portfile) >0) {
                $input = ['condition_flag' => 1];
                $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
                return $this->checkcondition($caseid);
            } else {
                $input = ['condition_flag' => 0];
                $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
              ->update($input);
                //return $this->checkcondition($caseid);
            }
        } elseif ($filecatgroup == 4) { //case Attacht
            $caseattacht = Case_Attacht::where('case_id', $caseid)->pluck('file_id')->toArray();
            $casefile = File::where('ref_number1', $caseid)->where('file_cat_id', $filecat)->where('status', "Active")->get();
            //return $casefile;
            if (count($casefile) >0) {
                $input = ['condition_flag' => 1];
                $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
                return $this->checkcondition($caseid);
            } else {
                $input = ['condition_flag' => 0];
                $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
              ->update($input);
                //return $this->checkcondition($caseid);
            }
        } elseif ($filecatgroup == 5) { //offer Attacht
        }
    }

    public function stagemove($caseid)
    {
      date_default_timezone_set('Asia/Bangkok');
      $day = date("d");
      $month = date("m");
      $year = date("Y")+543;
      $date = $day.'/'.$month.'/'.$year;
      $time = date('H:i:s');
        $allconditionok = 0;
        $tostage = 0;
        $commissionmethod = 0;

        $case = Cases::where('id', $caseid)->where('case_status',1)->get();
        foreach ($case as $ca) {
            $proceduretoprocess = Procedures_To_Process::where('procedure_id', $ca->procedure_id)->get();
            foreach ($proceduretoprocess as $proc) {
                if ($proc->start_process_flag == 1) {
                    $process = Process::where('id', $proc->process_id)->get();
                    foreach ($process as $pro) {
                        $stage = Stage::where('id', $ca->stage)->get();
                        foreach ($stage as $sta) {
                            //$path = Path::where('from_stage',$sta->id)->orderBy('path_priority','DESC')->take(1)->get();
                            if($ca->var_value129 == 1)
                            {
                              $path = Path::where('from_stage', 36)->get();
                               $caseconcount = Case_condition::where('current_stage',36)->where('path_condition_detail',70)->get();
                              if(count($caseconcount) <= 0)
                              {
                                $casecondition = new Case_condition;
                                $casecondition->name = "";
                                $casecondition->case_id = $ca->id;
                                $casecondition->condition_flag = 0;
                                $casecondition->current_stage = 36;
                                $casecondition->date_time =  $date." ".$time;
                                $casecondition->path_condition_detail = 70;
                                $casecondition->save();
                              }

                            }
                            else
                            {
                              $path = Path::where('from_stage', $sta->id)->get();//แก้ไขของเดิมคือ $sta->id
                            }
                            $arrayflag = array();
                          //  $allconditionok = 0;
                            foreach ($path as $pa) {
                                if ($pa->path_connection ==1) { // เป็น1ใช้ False วิ่ง
                                    $allconditionok = 1;
                                } else { //ใช้true วิ่ง
                                    $pathcondition = Path_condition::where('path_id',$pa->id)->get();//แก้ไขของเดิมคือpath_id $pa->id
                                  //  $allconditionok = 0;
                                    foreach ($pathcondition as $pathcon) {
                                        if ($pathcon->reverse_all_preposition == 1 ) {
                                            $allconditionok = 1;
                                        } else {
                                            if ($pathcon->reverse_each_preposition1 == 1 ) {
                                                $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail1)->value('condition_flag');

                                                if ($caseconditionflag == 0) {
                                                    $allconditionok = 1;
                                                } else {
                                                    $allconditionok = 0;
                                                }
                                            } else {
                                                if ($pathcon->path_condition_detail1 !=null && $allconditionok == 0) {
                                                    //$allconditionok = 0;
                                                    $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail1)->value('condition_flag');
                                                    if ($caseconditionflag == 1) {
                                                        $allconditionok = 1;
                                                    } else {
                                                        $allconditionok = 0;
                                                    }
                                                }
                                            }
                                            if ($pathcon->reverse_each_preposition2 == 1 && $allconditionok == 0) {
                                                $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail2)->value('condition_flag');
                                                if ($caseconditionflag == 0) {
                                                    $allconditionok = 1;
                                                } else {
                                                    $allconditionok = 0;
                                                }
                                            } else {
                                                if ($pathcon->path_condition_detail2 !=null && $allconditionok == 0) {
                                                    $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail2)->value('condition_flag');
                                                    if ($caseconditionflag == 1) {
                                                        $allconditionok = 1;
                                                    } else {
                                                        $allconditionok = 0;
                                                    }
                                                }
                                            }

                                            if ($pathcon->reverse_each_preposition3 == 1 && $allconditionok == 0) {
                                                $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail3)->value('condition_flag');
                                                if ($caseconditionflag == 0) {
                                                    $allconditionok = 1;
                                                } else {
                                                    $allconditionok = 0;
                                                }
                                            } else {
                                                if ($pathcon->path_condition_detail3 !=null && $allconditionok == 0) {
                                                    $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail3)->value('condition_flag');
                                                    if ($caseconditionflag == 1) {
                                                        $allconditionok = 1;
                                                    } else {
                                                        $allconditionok = 0;
                                                    }
                                                }
                                            }

                                            if ($pathcon->reverse_each_preposition4 == 1 && $allconditionok == 0) {
                                                $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail4)->value('condition_flag');
                                                if ($caseconditionflag == 0) {
                                                    $allconditionok = 1;
                                                } else {
                                                    $allconditionok = 0;
                                                }
                                            } else {
                                                if ($pathcon->path_condition_detail4 !=null && $allconditionok == 0) {
                                                    $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail4)->value('condition_flag');
                                                    if ($caseconditionflag == 1) {
                                                        $allconditionok = 1;
                                                    } else {
                                                        $allconditionok = 0;
                                                    }
                                                }
                                            }

                                            if ($pathcon->reverse_each_preposition5 == 1 && $allconditionok == 0) {
                                                $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail5)->value('condition_flag');
                                                if ($caseconditionflag == 0) {
                                                    $allconditionok = 1;
                                                } else {
                                                    $allconditionok = 0;
                                                }
                                            } else {
                                                if ($pathcon->path_condition_detail5 !=null && $allconditionok == 0) {
                                                    $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail5)->value('condition_flag');
                                                    if ($caseconditionflag == 1) {
                                                        $allconditionok = 1;
                                                    } else {
                                                        $allconditionok = 0;
                                                    }
                                                }
                                            }
                                            if ($pathcon->reverse_each_preposition6 == 1 && $allconditionok == 0) {
                                                $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail6)->value('condition_flag');
                                                if ($caseconditionflag == 0) {
                                                    $allconditionok = 1;
                                                } else {
                                                    $allconditionok = 0;
                                                }
                                            } else {
                                                if ($pathcon->path_condition_detail6 !=null && $allconditionok == 0) {
                                                    $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail6)->value('condition_flag');
                                                    if ($caseconditionflag == 1) {
                                                        $allconditionok = 1;
                                                    } else {
                                                        $allconditionok = 0;
                                                    }
                                                }
                                            }
                                            if ($pathcon->reverse_each_preposition7 == 1 && $allconditionok == 0) {
                                                $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail7)->value('condition_flag');
                                                if ($caseconditionflag == 0) {
                                                    $allconditionok = 1;
                                                } else {
                                                    $allconditionok = 0;
                                                }
                                            } else {
                                                if ($pathcon->path_condition_detail7 !=null && $allconditionok == 0) {
                                                    $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail7)->value('condition_flag');
                                                    if ($caseconditionflag == 1) {
                                                        $allconditionok = 1;
                                                    } else {
                                                        $allconditionok = 0;
                                                    }
                                                }
                                            }
                                            if ($pathcon->reverse_each_preposition8 == 1 && $allconditionok == 0) {
                                                $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail8)->value('condition_flag');
                                                if ($caseconditionflag == 0) {
                                                    $allconditionok = 1;
                                                } else {
                                                    $allconditionok = 0;
                                                }
                                            } else {
                                                if ($pathcon->path_condition_detail8 !=null && $allconditionok == 0) {
                                                    $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail8)->value('condition_flag');
                                                    if ($caseconditionflag == 1) {
                                                        $allconditionok = 1;
                                                    } else {
                                                        $allconditionok = 0;
                                                    }
                                                }
                                            }
                                            if ($pathcon->reverse_each_preposition9 == 1 && $allconditionok == 0) {
                                                $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail9)->value('condition_flag');
                                                if ($caseconditionflag == 0) {
                                                    $allconditionok = 1;
                                                } else {
                                                    $allconditionok = 0;
                                                }
                                            } else {
                                                if ($pathcon->path_condition_detail9 !=null && $allconditionok == 0) {
                                                    $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail9)->value('condition_flag');
                                                    if ($caseconditionflag == 1) {
                                                        $allconditionok = 1;
                                                    } else {
                                                        $allconditionok = 0;
                                                    }
                                                }
                                            }
                                            if ($pathcon->reverse_each_preposition10 == 1 && $allconditionok == 0) {
                                                $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail10)->value('condition_flag');
                                                if ($caseconditionflag == 0) {
                                                    $allconditionok = 1;
                                                } else {
                                                    $allconditionok = 0;
                                                }
                                            } else {
                                                if ($pathcon->path_condition_detail10 !=null && $allconditionok == 0) {
                                                    $caseconditionflag = Case_condition::where('case_id', $ca->id)->where('path_condition_detail', $pathcon->path_condition_detail10)->value('condition_flag');
                                                    if ($caseconditionflag == 1) {
                                                        $allconditionok = 1;
                                                    } else {
                                                        $allconditionok = 0;
                                                    }
                                                }
                                            }
                                        }
                                        array_push($arrayflag,$allconditionok);
                                        //return $pa->to_stage;
                                        $stageid = $sta->id;
                                        $fromstage = $pa->from_stage;
                                        $pathid = $pa->id;
                                        $pathcon = $pathcon->id;
                                        $tostage = $pa->to_stage;
                                        $caseid = $ca->id;
                                    }
                                }
                              //  return $allconditionok;

                                  /*  if($sta->id == 1 || $sta->id == 2)
                                    {

                                      $tostage = 22;
                                      $stageid = $sta->id;
                                      $caseid = $ca->id;
                                      $fromstage = $pa->from_stage;
                                      $pathid = $pa->id;
                                      $pathcon = $pathcon->id;
                                      $this->nextcasecondition($tostage,$caseid);
                                      $this->caselog($tostage,$stageid,$caseid,$fromstage,$pathid,$pathcon);
                                     $this->action($tostage,$stageid,$caseid);
                                   }*/
                              }
                            }
                            //return $allconditionok;
                            if($fromstage == 40 && $pa->to_stage == 42)
                            {
                              $findcasevalue36 = Cases::where('id', $caseid)->value('var_value36');
                              $findcasevalue37 = Cases::where('id', $caseid)->value('var_value37');
                              $findcasevalue38 = Cases::where('id', $caseid)->value('var_value38');
                                if($findcasevalue36 == 1 ||$findcasevalue37 == 1 ||$findcasevalue38 == 1 )
                                {
                                  $tostage = 41;
                                }
                            }
                            if (in_array(0,$arrayflag)) {
                            } else {
                              if ( $tostage != null ||  $tostage != 0) {
                                  $this->nextcasecondition($tostage, $caseid);
                                  $this->caselog($tostage, $stageid, $caseid, $fromstage, $pathid, $pathcon);
                                  $this->action($tostage, $stageid, $caseid);
                              }
                            /////////truly    return $allconditionok;
                        }
                        //return $stage;
                    }
                    //  return $process;
                } else {
                }
            }
            //  return $proceduretoprocess;
        }
        //return "Yes";
    }
    public function caselog($tostage, $stageid, $caseid, $fromstage, $pathid, $pathcon)
    {
        date_default_timezone_set('Asia/Bangkok');
        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        $date = $day."/".$month."/".$year;
        $time = date('H:i:s');
        $findcaselo = Case_log::where('move_from_stage', $fromstage)->where('move_to_stage', $tostage)->where('moving_path', $pathid)->where('case_id', $caseid)->get();
        if (count($findcaselo) >=1) {
        } else {
            $caselog = new Case_log;
            $caselog->case_id = $caseid;
            $caselog->date_time = $date." ".$time;
            $caselog->move_from_stage = $fromstage;
            $caselog->move_to_stage = $tostage;
            $caselog->moving_path = $pathid;
            //    $caselog->condition_match = $pathcon;
            $caselog->description = "";
            $caselog->save();
        }
    }
    public function action($tostage, $stageid, $caseid)
    {
        $datacontoller = new DataController();

        $stageaction = StageAction::where('current_stage_id', $stageid)->get();
        foreach ($stageaction as $stageac) {
            //return $stageaction;
            if ($stageac->action_id == 30) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;

                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 29) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 28) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 27) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 26) { //สร้าง New Asset
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $casemiddledata = Casemiddledata::with(['Offer'])->where('case_id', $caseid)->get();
                        if (count($casemiddledata) >= 1) {
                            foreach ($casemiddledata as $ca) {
                                $assettype = OfferType::where('id', $ca->Offer->type_id)->value('asset_type');

                                //  if($assettype == 6 ||$assettype == 10 ||$assettype == 11 ||$assettype == 12 ||$assettype == 13 ||$assettype == 14)

                                $offerid = $ca->offer_id;
                                $this->insurancnewasset($assettype, $offerid, $caseid);
                            }
                        } else {
                        }

                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 25) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 24) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 23) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 22) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 21) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 20) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 19) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 18) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 17) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 16) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 15) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 14) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 12) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 13) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 3) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $caseowner = Cases::where('id', $caseid)->value('member_case_owner');
                        $reciver = match_id::where('member_id', $caseowner)->value('id');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;

                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 4) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $reciver = Cases::where('id', $caseid)->value('created_by_pid');
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;

                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 5) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $partnerblock = Cases::where('id', $caseid)->value('consult_partner_block_id');
                        $reciver = $datacontoller->findpublicidinpartnerblock($partnerblock);
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 6) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $userblock = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = $datacontoller->findpublicidinuserblock($userblock);
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 7) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $userid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = $datacontoller->findpublicidinuserid($userid);
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 8) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $reciver = $stageac->action_para_value9;
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 9) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $guildid = $stageac->action_para_value9;
                        $reciver = $datacontoller->findpublicidinguildid($guildid);
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotifygroup($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 10) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $partnergroupid = $stageac->action_para_value9;
                        $reciver = $datacontoller->findpublicidinpartnergroup($partnergroupid);
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotifygroup($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageac->action_id == 11) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageac->id)->where('action_stage_id', $stageac->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageac->action_time == 1) {
                        $pidgroupid = $stageac->action_para_value9;
                        $reciver = $datacontoller->findpublicidinpidgroup($pidgroupid);
                        $cc1 = $stageac->action_para_value6;
                        $cc2 = $stageac->action_para_value7;
                        $cc3 = $stageac->action_para_value8;
                        $topic = $stageac->action_para_value2;
                        $message = $stageac->action_para_value3;
                        $reflink = $stageac->action_para_value4;
                        $sendernote = $stageac->action_para_value5;
                        $messagetype = $stageac->action_para_value1;
                        $this->actionnotifygroup($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageac->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageac->current_stage_id;
                        $caseaction->action_time = $stageac->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
        }
        //  return $tostage;
        $findcasevalue = Cases::where('id', $caseid)->value('var_value130');
        if ($findcasevalue == 1) {
            $tostage = 31;
        }
        $input = ['stage' => $tostage];
        Cases::where('stage', $stageid)->where('id', $caseid)
          ->update($input);
        $stageactionout = StageAction::where('current_stage_id', $tostage)->get();
        foreach ($stageactionout as $stageacout) {
            if ($stageacout->action_id == 3) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $caseowner = Cases::where('id', $caseid)->value('member_case_owner');
                        $reciver = match_id::where('member_id', $caseowner)->value('id');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 4) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $reciver = Cases::where('id', $caseid)->value('created_by_pid');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 5) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $partnerblock = Cases::where('id', $caseid)->value('consult_partner_block_id');
                        $reciver = $datacontoller->findpublicidinpartnerblock($partnerblock);
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 6) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $userblock = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = $datacontoller->findpublicidinuserblock($userblock);
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 7) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $userid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = $datacontoller->findpublicidinuserid($userid);
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 8) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $reciver = $stageacout->action_para_value9;
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 9) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $guildid = $stageacout->action_para_value9;
                        $reciver = $datacontoller->findpublicidinguildid($guildid);
                        //return $reciver;
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotifygroup($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 10) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $partnergroupid = $stageacout->action_para_value9;
                        $reciver = $datacontoller->findpublicidinpartnergroup($partnergroupid);
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotifygroup($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 11) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $pidgroupid = $stageacout->action_para_value9;
                        $reciver = $datacontoller->findpublicidinpidgroup($pidgroupid);
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotifygroup($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
                //return $this->stagemove();
            }
            if ($stageacout->action_id == 12) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 13) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 15) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 14) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 17) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 16) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 19) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 18) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 21) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 20) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 23) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 22) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 25) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 24) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 26) { //สร้าง New Asset
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $casemiddledata = Casemiddledata::with(['Offer'])->where('case_id', $caseid)->get();
                        if (count($casemiddledata) >= 1) {
                            foreach ($casemiddledata as $ca) {
                                $assettype = OfferType::where('id', $ca->Offer->type_id)->value('asset_type');

                                //  if($assettype == 6 ||$assettype == 10 ||$assettype == 11 ||$assettype == 12 ||$assettype == 13 ||$assettype == 14)

                                $offerid = $ca->offer_id;
                                $this->insurancnewasset($assettype, $offerid, $caseid);
                            }
                        } else {
                        }

                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }

            if ($stageacout->action_id == 28) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 27) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }

            if ($stageacout->action_id == 30) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $coorid = Cases::where('id', $caseid)->value('coordinate_user_block_id');
                        $reciver = match_id::where('user_id', $coorid)->value('id');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
            if ($stageacout->action_id == 29) {
                $checkcaseaction = CaseAction::where('case_id', $caseid)->where('stage_action', $stageacout->id)->where('action_stage_id', $stageacout->current_stage_id)->value('action_flag');
                if ($checkcaseaction == 0) {
                    if ($stageacout->action_time == 0) {
                        $userblockid = Cases::where('id', $caseid)->value('service_user_block_id');
                        $reciver = block::where('id', $userblockid)->value('default_pid');
                        $cc1 = $stageacout->action_para_value6;
                        $cc2 = $stageacout->action_para_value7;
                        $cc3 = $stageacout->action_para_value8;
                        $topic = $stageacout->action_para_value2;
                        $message = $stageacout->action_para_value3;
                        $reflink = $stageacout->action_para_value4;
                        $sendernote = $stageacout->action_para_value5;
                        $messagetype = $stageacout->action_para_value1;
                        $this->actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver);
                        $caseaction = new CaseAction;
                        $caseaction->case_id = $caseid;
                        $caseaction->stage_action = $stageacout->id;
                        $caseaction->action_flag = 1;
                        $caseaction->action_stage_id = $stageacout->current_stage_id;
                        $caseaction->action_time = $stageacout->action_time;
                        date_default_timezone_set('Asia/Bangkok');
                        $day = date("d");
                        $month = date("m");
                        $year = date("Y")+543;
                        $date = $day."/".$month."/".$year;
                        $time = date('H:i:s');
                        $caseaction->time = $date." ".$time;
                        $caseaction->save();
                    }
                }
            }
        }
    }
    public function insurancnewasset($assettype, $offerid, $caseid)
    {
        $getoffer = Offer::find($offerid);
        $getcase = Cases::find($caseid);
        if($getcase->var_value128 == NULL ||$getcase->var_value128 == '' ||$getcase->var_value128 == 0 )
        {
          $portfolio = Portfolio::where('member_id', $getcase->member_case_owner)->where('structure_id', 14)->value('id');
        if ($portfolio == null ||$portfolio == ''||$portfolio == 0) {
            $creatport = new Portfolio;
            $creatport->type = $getcase->var_value48;
            $creatport->type = $getcase->var_value48;
            $creatport->number = '';
            $creatport->structure_id = 14;
            $creatport->block_id = $getcase->service_user_block_id;
            $creatport->member_id = $getcase->member_case_owner;
            $creatport->port_id = 31;
            $creatport->status = 'Active';
            $creatport->save();
            $portfolio =$creatport->id;
        }
      }
      else
      {
        $portfolio = $getcase->var_value128;
      }
        $createasset = new Asset;
        $createasset->name = $getcase->var_value47;
        $createasset->ref_name = $getcase->var_value47;
        $createasset->la_nla_type = $assettype;
        $createasset->port_id = $portfolio;
        $createasset->ref_number1 = '';
        $createasset->ref_info1 = $getoffer->offer_value1;
        $createasset->ref_info2 = $getoffer->offer_value2;
        $createasset->ref_info3 = $getoffer->offer_value3;
        $createasset->ref_info4 = $getoffer->offer_value4;
        $createasset->ref_info5 = $getoffer->offer_value5;
        $createasset->ref_info6 = $getoffer->offer_value6;
        $createasset->ref_info7 = $getoffer->offer_value7;
        $createasset->ref_info8 = $getoffer->offer_value8;
        $createasset->ref_info9 = $getoffer->offer_value9;
        $createasset->ref_info10 = $getoffer->offer_value10;
        $createasset->ref_info11 = $getoffer->offer_value11;
        $createasset->ref_info12 = $getoffer->offer_value12;
        $createasset->ref_info13 = $getoffer->offer_value13;
        $createasset->ref_info14 = $getoffer->offer_value14;
        $createasset->ref_info15 = $getoffer->offer_value15;
        $createasset->ref_info16 = $getoffer->offer_value16;
        $createasset->ref_info17 = $getoffer->offer_value17;
        $createasset->ref_info18 = $getoffer->offer_value18;
        $createasset->issued_by = $getoffer->ref_member_id;
        $createasset->branch_id = $getoffer->ref_branch_id;
        $createasset->created_from_caseid = $caseid;
        //  $createasset->valid_from = $caseid;
        //  $createasset->valid_to = $caseid;

        $findrenew = Cases::where('id', $caseid)->value('ref_previous_case');
        $createasset->renew_from_caseid = $findrenew;
        $createasset->save();
        date_default_timezone_set('Asia/Bangkok');
        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        $date = $day."/".$month."/".$year;
        $time = date('H:i:s');
        Asset_Transaction::create([
         'date' => $date,
         'time' => $time,
         'l_s' => 'Long',
         'o_c' => 'Open',
         'port_id' => $createasset->port_id,
         'asset_id' => $createasset->id,
         //'symbol' => $request['symbol'],
        // 'underlying_id' => $request['underlying_id'],
         'volumn' => '1',
         'price' => $getoffer->offer_payment_value4,
         'status' => '1',
         //'note' => $request['note'],
     ]);
    }
    public function actionnotifygroup($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver)
    {
        $messagetype = $messagetype;
        $current = Auth::user()->id;
        $sender = match_id::where('user_id', $current)->value('id');
        $noticenter = new NotiCenterController;
        $recievernote = "";
        $status = "";
        $createdby = $sender;
        return $noticenter->notigroup($createdby, $cc1, $cc2, $cc3, $messagetype, $topic, $message, $reflink, $sendernote, $recievernote, $status, $sender, $reciver);
        //return $this->action();
    }
    public function actionnotify($sendernote, $reflink, $message, $topic, $cc1, $cc2, $cc3, $messagetype, $caseid, $reciver)
    {
        $messagetype = $messagetype;
        $current = Auth::user()->id;
        $sender = match_id::where('user_id', $current)->value('id');
        $noticenter = new NotiCenterController;
        $recievernote = "";
        $status = "";
        $createdby = $sender;
        return $noticenter->sentnoti($createdby, $cc1, $cc2, $cc3, $messagetype, $topic, $message, $reflink, $sendernote, $recievernote, $status, $sender, $reciver);
    }
    ////////////////////////////////////////conditioncomparefunction
    public function conditioncomparevalueequal($caseid, $pathconid, $pathconvaluetocompare, $case)
    {
        if ($case === $pathconvaluetocompare) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function conditioncomparevaluenotequal($caseid, $pathconid, $pathconvaluetocompare, $case)
    {
        if ($case != $pathconvaluetocompare) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function conditioncomparevaluemorethan($caseid, $pathconid, $pathconvaluetocompare, $case)
    {
        if ($case > $pathconvaluetocompare) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function conditioncomparevaluelowerthan($caseid, $pathconid, $pathconvaluetocompare, $case)
    {
        if ($case < $pathconvaluetocompare) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function conditioncomparevaluelowerthanorequal($caseid, $pathconid, $pathconvaluetocompare, $case)
    {
        if ($case <= $pathconvaluetocompare) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    public function conditioncomparevaluemorethanorequal($caseid, $pathconid, $pathconvaluetocompare, $case)
    {
        if ($case >= $pathconvaluetocompare) {
            $input = ['condition_flag' => 1];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
            return $this->checkcondition($caseid);
        } else {
            $input = ['condition_flag' => 0];
            $casee = Case_condition::where('case_id', $caseid)->where('path_condition_detail', $pathconid)
            ->update($input);
        }
    }
    ////////////////////////////////////////conditioncomparefunction
}

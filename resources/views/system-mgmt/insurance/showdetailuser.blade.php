@extends('system-mgmt.insurance.base')
@section('action-content')
<!-- Main content -->
<style>
  .tablescroll {
    max-height: 70px;
    overflow-y: auto;
  }

  .rating-star,
  .rating:hover .rating-star {
    position: relative;
    display: block;
    float: right;
    width: 16px;
    height: 16px;
    background: url('https://www.everythingfrontend.com/samples/star-rating/star.png') 0 -16px;
  }

  .rating {
    overflow: hidden;
    display: inline-block;
  }

  .rating-input {
    float: right;
    width: 16px;
    height: 16px;
    padding: 0;
    margin: 0 0 0 -16px;
    opacity: 0;
  }

  .column {
    float: left;
    width: 100%;

    /* Should be removed. Only for demonstration */
  }

  .columnshow2 {
    float: left;
    width: 50%;
    padding: 10px;
    /* Should be removed. Only for demonstration */
  }

  .column2 {
    float: left;
    width: 33.33%;
    padding: 10px;

    /* Should be removed. Only for demonstration */
  }

  .column3 {
    float: left;
    width: 20%;
    padding: 10px;

    /* Should be removed. Only for demonstration */
  }

  .columnanotherfile {
    float: left;
    width: 40%;
    padding: 10px;

    /* Should be removed. Only for demonstration */
  }

  .columnsome2 {
    float: left;
    width: 50%;

    /* Should be removed. Only for demonstration */
  }

  .column2fordis {
    float: left;
    width: 50%;
    /* Should be removed. Only for demonstration */
  }

  .column22 {
    float: left;
    width: 33.33%;
    padding: 10px;

    /* Should be removed. Only for demonstration */
  }

  .column3 {
    float: left;
    width: 33.33%;
    padding: 10px;

    /* Should be removed. Only for demonstration */
  }

  .column4 {
    float: left;
    width: 25%;
    padding: 10px;

    /* Should be removed. Only for demonstration */
  }

  @media screen and (max-width: 1500px) {
    .column2 {
      width: 100%;
    }

    .column2fordis {
      width: 100%;
    }

    .column3 {
      width: 100%;
    }

    .column4 {
      width: 100%;
    }

    .column3 {
      width: 100%;
    }

    .column2 {
      width: 100%;
    }

    .column22 {
      width: 100%;
    }

    .columnshow2 {
      width: 50%;
    }

    .columnanotherfile {
      width: 100%;

      /* Should be removed. Only for demonstration */
    }

  }

  .borderna {
    border: 1px solid #ddd;
    border: 1px solid #ddd;
  }

  .card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: .25rem
  }

  .card>hr {
    margin-right: 0;
    margin-left: 0
  }

  .card>.list-group:first-child .list-group-item:first-child {
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem
  }

  .card>.list-group:last-child .list-group-item:last-child {
    border-bottom-right-radius: .25rem;
    border-bottom-left-radius: .25rem
  }

  .card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem
  }

  .card-title {
    margin-bottom: .75rem
  }

  .card-subtitle {
    margin-top: -.375rem;
    margin-bottom: 0
  }

  .card-text:last-child {
    margin-bottom: 0
  }

  .card-link:hover {
    text-decoration: none
  }

  .card-link+.card-link {
    margin-left: 1.25rem
  }

  .card-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0, 0, 0, .03);
    border-bottom: 1px solid rgba(0, 0, 0, .125)
  }

  .card-header:first-child {
    border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
  }

  .card-header+.list-group .list-group-item:first-child {
    border-top: 0
  }

  .card-footer {
    padding: .75rem 1.25rem;
    background-color: rgba(0, 0, 0, .03);
    border-top: 1px solid rgba(0, 0, 0, .125)
  }

  .card-footer:last-child {
    border-radius: 0 0 calc(.25rem - 1px) calc(.25rem - 1px)
  }

  .card-header-tabs {
    margin-right: -.625rem;
    margin-bottom: -.75rem;
    margin-left: -.625rem;
    border-bottom: 0
  }

  .card-header-pills {
    margin-right: -.625rem;
    margin-left: -.625rem
  }

  .card-img-overlay {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    padding: 1.25rem
  }

  .card-img {
    width: 100%;
    border-radius: calc(.25rem - 1px)
  }

  .card-img-top {
    width: 100%;
    border-top-left-radius: calc(.25rem - 1px);
    border-top-right-radius: calc(.25rem - 1px)
  }

  .card-img-bottom {
    width: 100%;
    border-bottom-right-radius: calc(.25rem - 1px);
    border-bottom-left-radius: calc(.25rem - 1px)
  }

  .card-deck {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column
  }

  .card-deck .card {
    margin-bottom: 15px
  }

  @media(min-width:576px) {
    .card-deck {
      -ms-flex-flow: row wrap;
      flex-flow: row wrap;
      margin-right: -15px;
      margin-left: -15px
    }

    .card-deck .card {
      display: -ms-flexbox;
      display: flex;
      -ms-flex: 1 0 0%;
      flex: 1 0 0%;
      -ms-flex-direction: column;
      flex-direction: column;
      margin-right: 15px;
      margin-bottom: 0;
      margin-left: 15px
    }
  }

  .card-group {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column
  }

  .card-group>.card {
    margin-bottom: 15px
  }

  @media(min-width:576px) {
    .card-group {
      -ms-flex-flow: row wrap;
      flex-flow: row wrap
    }

    .card-group>.card {
      -ms-flex: 1 0 0%;
      flex: 1 0 0%;
      margin-bottom: 0
    }

    .card-group>.card+.card {
      margin-left: 0;
      border-left: 0
    }

    .card-group>.card:first-child {
      border-top-right-radius: 0;
      border-bottom-right-radius: 0
    }

    .card-group>.card:first-child .card-header,
    .card-group>.card:first-child .card-img-top {
      border-top-right-radius: 0
    }

    .card-group>.card:first-child .card-footer,
    .card-group>.card:first-child .card-img-bottom {
      border-bottom-right-radius: 0
    }

    .card-group>.card:last-child {
      border-top-left-radius: 0;
      border-bottom-left-radius: 0
    }

    .card-group>.card:last-child .card-header,
    .card-group>.card:last-child .card-img-top {
      border-top-left-radius: 0
    }

    .card-group>.card:last-child .card-footer,
    .card-group>.card:last-child .card-img-bottom {
      border-bottom-left-radius: 0
    }

    .card-group>.card:only-child {
      border-radius: .25rem
    }

    .card-group>.card:only-child .card-header,
    .card-group>.card:only-child .card-img-top {
      border-top-left-radius: .25rem;
      border-top-right-radius: .25rem
    }

    .card-group>.card:only-child .card-footer,
    .card-group>.card:only-child .card-img-bottom {
      border-bottom-right-radius: .25rem;
      border-bottom-left-radius: .25rem
    }

    .card-group>.card:not(:first-child):not(:last-child):not(:only-child) {
      border-radius: 0
    }

    .card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer,
    .card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,
    .card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,
    .card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top {
      border-radius: 0
    }
  }

  .card-columns .card {
    margin-bottom: .75rem
  }

  @media(min-width:576px) {
    .card-columns {
      -webkit-column-count: 3;
      -moz-column-count: 3;
      column-count: 3;
      -webkit-column-gap: 1.25rem;
      -moz-column-gap: 1.25rem;
      column-gap: 1.25rem;
      orphans: 1;
      widows: 1
    }

    .card-columns .card {
      display: inline-block;
      width: 100%
    }
  }

  .accordion .card:not(:first-of-type):not(:last-of-type) {
    border-bottom: 0;
    border-radius: 0
  }

  .accordion .card:not(:first-of-type) .card-header:first-child {
    border-radius: 0
  }

  .accordion .card:first-of-type {
    border-bottom: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0
  }

  .accordion .card:last-of-type {
    border-top-left-radius: 0;
    border-top-right-radius: 0
  }

  div.sticky {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    padding: 5px;
    background-color: #cae8ca;
    border: 2px solid #4CAF50;
  }
</style>
<section class="content">
  <div class="box">
    <div class="box-header">
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>

      <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <div id="caseheaderuser" data-id="{{ $id }}" data-recheckflag="{{$caseheaderrecheckofferflag}}" data-casename="{{ $caseheadername }}" data-prevnote="{{ $caseheadernotefromprevious }}" data-renewnote="{{ $caseheadernotecopytorenew }}" data-membernote="{{ $caseheadernotefrommember }}"
                  data-partnernote="{{ $caseheadernotefrompartner }}" data-usernote="{{ $caseheadernotefromuser }}" data-var130="{{ $caseheadervar130 }}" data-canceldate="{{ $caseheadercanceldate }}" data-renewcaseid="{{ $caseheaderrenewcaseid }}">
                </div>
              </div>
              <div class="card-body">
                <div class="column">
                  <div class="column">
                  <div class="column3">
                  <a class="btn btn-default btn-margin"  href="{{url()->current()}}/?mode=open">+ All</a>
                  <a class="btn btn-default btn-margin"  href="{{url()->current()}}/?mode=hide">- All</a>
                  </div>

                </div>
                <div class="column">
                <div style="text-align:center" class="" id="caseselectportfolio"  data-id="{{ $id }}" data-caseport="{{$caseport}}" data-customername="{{$casecustomername}}" data-customerlname="{{ $casecustomerlastname }}">
                </div>
                </div>
                  <div class="" id="caseclassify" data-casename="{{ $caseheadername }}" data-id="{{ $id }}" data-casecat="{{ $caseclassifycat }}" data-casetype="{{ $caseclassifytype }}" data-casesubtype="{{ $caseclassifysubtype }}"
                    data-oldcase="{{ $caseclassifyoldcase }}" data-oldcaseid="{{ $caseclassifyoldcaseid }}" data-renewcase="{{ $caseclassifyrenewcase }}" data-renewcaseid="{{ $caseclassifyrenewcaseid }}">
                  </div>
                  <div class="" id="casedetail" data-id="{{ $id }}" data-matchid="{{ $casedetailmatchid }}" data-userblock="{{ $casedetailserviceuser }}" data-coordinator="{{ $casedetailcoordinate }}"
                    data-consultpartner="{{ $casedetailconsultpartner }}" data-casechannel="{{ $casedetailcasechannel }}" data-caserefasset="{{ $casedetailrefasset }}">
                  </div>
                  <div class="" id="casetracking" data-id="{{ $id }}" data-casestatus="{{ $casetrackingcasestatus }}" data-casestage="{{ $casetrackingstage }}" data-finishdate="{{ $casetrackingfinisheddate }}"
                    data-autorenewdate="{{ $casetrackingautorenewdate }}" data-lastupdatedate="{{ $casetrackinglastupdatedate }}" data-varname1="{{ $casetrackingvarname1 }}" data-requirevalue7="{{ $casetrackingrequirevalue7 }}"
                    data-requirevalue8="{{ $casetrackingrequirevalue8 }}" data-requirevalue9="{{$casetrackingrequirevalue9 }}" data-varname51="{{$casetrackingvarname51 }}" data-varname52="{{$casetrackingvarname52 }}"
                    data-varname53="{{$casetrackingvarname53 }}" data-varname1="{{$casetrackingvarname1 }}" data-varname2="{{$casetrackingvarname2 }}" data-varname3="{{$casetrackingvarname3 }}" data-varname4="{{$casetrackingvarname4 }}"
                    data-varname5="{{$casetrackingvarname5 }}" data-varname6="{{$casetrackingvarname6 }}" data-varname7="{{$casetrackingvarname7 }}" data-varname8="{{$casetrackingvarname8 }}" data-varname9="{{$casetrackingvarname9 }}"
                    data-varname10="{{$casetrackingvarname10 }}" data-varname11="{{$casetrackingvarname11 }}" data-varname12="{{$casetrackingvarname12 }}" data-varname13="{{$casetrackingvarname13 }}" data-varname14="{{$casetrackingvarname14 }}"
                    data-varname15="{{$casetrackingvarname15 }}" data-varname16="{{$casetrackingvarname16 }}" data-varname17="{{$casetrackingvarname17 }}" data-varname18="{{$casetrackingvarname18 }}" data-varname19="{{$casetrackingvarname19 }}"
                    data-varname20="{{$casetrackingvarname20 }}" data-varname21="{{$casetrackingvarname21 }}" data-varname22="{{$casetrackingvarname22 }}" data-varname23="{{$casetrackingvarname23 }}" data-varname24="{{$casetrackingvarname24 }}"
                    data-varname25="{{$casetrackingvarname25 }}" data-varvalue51="{{$casetrackingvarvalue51 }}" data-varvalue52="{{$casetrackingvarvalue52 }}" data-varvalue53="{{$casetrackingvarvalue53 }}" data-varvalue1="{{$casetrackingvarvalue1 }}"
                    data-varvalue2="{{$casetrackingvarvalue2 }}" data-varvalue3="{{$casetrackingvarvalue3 }}" data-varvalue4="{{$casetrackingvarvalue4 }}" data-varvalue5="{{$casetrackingvarvalue5 }}" data-varvalue6="{{$casetrackingvarvalue6 }}"
                    data-varvalue7="{{$casetrackingvarvalue7 }}" data-varvalue8="{{$casetrackingvarvalue8 }}" data-varvalue9="{{$casetrackingvarvalue9 }}" data-varvalue10="{{$casetrackingvarvalue10 }}" data-varvalue11="{{$casetrackingvarvalue11 }}"
                    data-varvalue12="{{$casetrackingvarvalue12 }}" data-varvalue13="{{$casetrackingvarvalue13 }}" data-varvalue14="{{$casetrackingvarvalue14 }}" data-varvalue15="{{$casetrackingvarvalue15 }}"
                    data-varvalue16="{{$casetrackingvarvalue16 }}" data-varvalue17="{{$casetrackingvarvalue17 }}" data-varvalue18="{{$casetrackingvarvalue18 }}" data-varvalue19="{{$casetrackingvarvalue19 }}"
                    data-varvalue20="{{$casetrackingvarvalue20 }}" data-varvalue21="{{$casetrackingvarvalue21 }}" data-varvalue22="{{$casetrackingvarvalue22 }}" data-varvalue23="{{$casetrackingvarvalue23 }}"
                    data-varvalue24="{{$casetrackingvarvalue24 }}" data-varvalue25="{{$casetrackingvarvalue25 }}">
                  </div>
                </div>
                <div class="column">
                  <div class="" id="casedetailnoti" data-id="{{ $id }}" data-requirename7="{{$casedetailnotirequirename7}}" data-requirename8="{{$casedetailnotirequirename8}}" data-requirename9="{{$casedetailnotirequirename9}}"
                    data-requirename10="{{$casedetailnotirequirename10}}" data-requirename11="{{$casedetailnotirequirename11}}" data-requirename12="{{$casedetailnotirequirename12}}" data-requirename13="{{$casedetailnotirequirename13}}"
                    data-requirename14="{{$casedetailnotirequirename14}}" data-requirename15="{{$casedetailnotirequirename15}}" data-requirename1="{{$casedetailnotirequirename1}}" data-requirename2="{{$casedetailnotirequirename2}}"
                    data-requirename4="{{$casedetailnotirequirename4}}" data-requirename3="{{$casedetailnotirequirename3}}" data-requirename5="{{$casedetailnotirequirename5}}" data-requirename6="{{$casedetailnotirequirename6}}"
                    data-requirevalue7="{{$casedetailnotirequirevalue7}}" data-requirevalue8="{{$casedetailnotirequirevalue8}}" data-requirevalue9="{{$casedetailnotirequirevalue9}}" data-requirevalue10="{{$casedetailnotirequirevalue10}}"
                    data-requirevalue11="{{$casedetailnotirequirevalue11}}" data-requirevalue12="{{$casedetailnotirequirevalue12}}" data-requirevalue13="{{$casedetailnotirequirevalue13}}" data-requirevalue14="{{$casedetailnotirequirevalue14}}"
                    data-requirevalue15="{{$casedetailnotirequirevalue15}}" data-requirevalue1="{{$casedetailnotirequirevalue1}}" data-requirevalue2="{{$casedetailnotirequirevalue2}}" data-requirevalue3="{{$casedetailnotirequirevalue3}}"
                    data-requirevalue5="{{$casedetailnotirequirevalue5}}" data-requirevalue6="{{$casedetailnotirequirevalue6}}" data-requirevalue4="{{$casedetailnotirequirevalue4}}">
                  </div>
                  <div class="" id="casecustomerdetail" data-id="{{ $id }}" data-customername="{{ $casecustomeradvisor }}" data-customername="{{ $casecustomername }}" data-customerlastname="{{ $casecustomerlastname }}" data-customeremail="{{ $casecustomeremail }}"
                    data-customermobile="{{ $casecustomermobile }}" data-customerfax="{{ $casecustomerfax }}" data-customeraddress="{{ $casecustomeraddress }}">
                  </div>
                  <div class="" id="casecontactdetail" data-id="{{ $id }}" data-varname16="{{ $casecontactrequirename16 }}" data-varname17="{{ $casecontactrequirename17 }}" data-varname18="{{ $casecontactrequirename18 }}"
                    data-varname19="{{ $casecontactrequirename19 }}" data-varname20="{{ $casecontactrequirename20 }}" data-varvalue16="{{ $casecontactrequirevalue16 }}" data-varvalue17="{{ $casecontactrequirevalue17 }}"
                    data-varvalue18="{{ $casecontactrequirevalue18 }}" data-varvalue19="{{ $casecontactrequirevalue19 }}" data-varvalue20="{{ $casecontactrequirevalue20 }}">
                  </div>
                </div>
                <div class="column">
                  <div class="" id="casedriver"  data-id="{{ $id }}" data-varname55="{{ $casevarname55 }}" data-varvalue55="{{ $casevarvalue55 }}"  data-varname56="{{ $casevarname56 }}" data-varvalue56="{{ $casevarvalue56 }}"  data-varname57="{{ $casevarname57 }}" data-varvalue57="{{ $casevarvalue57 }}" data-varname58="{{ $casevarname58 }}"
                  data-varvalue58="{{ $casevarvalue58 }}">
                </div>
                <div class="" id="casebenefit"  data-id="{{ $id }}" data-varname54="{{ $casevarname54 }}" data-varvalue54="{{ $casevarvalue54 }}"  data-varname59="{{ $casevarname59 }}" data-varvalue59="{{ $casevarvalue59 }}"  data-varname60="{{ $casevarname60 }}" data-varvalue60="{{ $casevarvalue60 }}"
                data-varname61="{{ $casevarname61 }}"data-varvalue61="{{ $casevarvalue61 }}"
                data-varname62="{{ $casevarname62 }}" data-varvalue62="{{ $casevarvalue62 }}"
                data-varname63="{{ $casevarname63 }}" data-varvalue63="{{ $casevarvalue63 }}"
                data-varname64="{{ $casevarname64 }}" data-varvalue64="{{ $casevarvalue64 }}"
                data-varname65="{{ $casevarname65 }}" data-varvalue65="{{ $casevarvalue65 }}"
                data-varname66="{{ $casevarname66 }}" data-varvalue66="{{ $casevarvalue66 }}"
                data-varname67="{{ $casevarname67 }}" data-varvalue67="{{ $casevarvalue67 }}"
                data-varname68="{{ $casevarname68 }}" data-varvalue68="{{ $casevarvalue68 }}"
                data-varname69="{{ $casevarname69 }}" data-varvalue69="{{ $casevarvalue69 }}">
              </div>
              <div id="subdata" data-id="{{ $id }}" data-varname47="{{$casevarname47}}" data-varname48="{{$casevarname48}}" data-varname49="{{$casevarname49}}" data-varname50="{{$casevarname50}}" data-varvalue47="{{$casevarvalue47}}" data-varvalue48="{{$casevarvalue48}}" data-varvalue49="{{$casevarvalue49}}" data-varvalue50="{{$casevarvalue50}}">
              </div>
                </div>
                <div class="column">
                  <div class="" id="offerinsurance" data-id="{{ $id }}" data-companyname="{{ $offerinsurancecompany }}" data-varname11="{{$casetrackingvarname11 }}" data-varvalue11="{{$casetrackingvarvalue11 }}"
                    data-partnername="{{ $offerinsurancepartner }}" data-varname41="{{ $casevarname41 }}" data-varname42="{{ $casevarname42 }}" data-varname43="{{ $casevarname43 }}" data-varvalue41="{{ $casevarvalue41 }}"
                    data-varvalue42="{{ $casevarvalue42 }}" data-varvalue43="{{ $casevarvalue43 }}" data-filepublicname="{{ $offerinsurancefilepublicname }}" data-fileid="{{ $offerinsurancefileid }}" data-varvalue52="{{ $casevarvalue52 }}"
                    data-varname52="{{ $casevarname52 }}" data-varname14="{{$casetrackingvarname14 }}" data-varvalue14="{{$casetrackingvarvalue14 }}">

                  </div>
                  <div class="" id="offeract" data-id="{{ $id }}" data-companyname="{{ $offeractcompany }}" data-partnername="{{ $offeractpartner }}" data-varname38="{{ $casevarname38 }}" data-varname39="{{ $casevarname39 }}"
                    data-varname40="{{ $casevarname40 }}" data-varvalue38="{{ $casevarvalue38 }}" data-varvalue39="{{ $casevarvalue39 }}" data-varvalue40="{{ $casevarvalue40 }}" data-filepublicname="{{ $offeractfilepublicname }}"
                    data-fileid="{{ $offeractfileid }}" data-varname12="{{$casetrackingvarname12 }}" data-varvalue12="{{$casetrackingvarvalue12 }}" data-varvalue52="{{ $casevarvalue52 }}" data-varname52="{{ $casevarname52 }}"
                    data-varname51="{{$casetrackingvarname51 }}" data-varvalue15="{{$casetrackingvarvalue15 }}">
                  </div>
                  <div class="" id="offertax" data-id="{{ $id }}" data-companyname="{{ $offertaxcompany }}" data-partnername="{{ $offertaxpartner }}" data-varname44="{{ $casevarname44 }}" data-varname45="{{ $casevarname45 }}"
                    data-varname46="{{ $casevarname46 }}" data-varvalue44="{{ $casevarvalue44 }}" data-varvalue45="{{ $casevarvalue45 }}" data-varvalue46="{{ $casevarvalue46 }}" data-filepublicname="{{ $offertaxfilepublicname }}"
                    data-fileid="{{ $offertaxfileid }}" data-varname13="{{$casetrackingvarname13 }}" data-varvalue13="{{$casetrackingvarvalue13 }}" data-varvalue53="{{ $casevarvalue53 }}" data-varname53="{{ $casevarname53}}"
                    data-varname53="{{$casetrackingvarname53 }}" data-varvalue16="{{$casetrackingvarvalue16 }}" data-varname16="{{$casetrackingvarname16 }}">
                  </div>
                  <div class="column">
                    <div class="" id="assetdetail" data-id="{{ $id }}" data-assetid="{{ $caseassetid }}" data-refname="{{ $caseassetrefname }}" data-refinfo3="{{ $caseassetrefinfo3 }}" data-refinfo4="{{ $caseassetrefinfo4 }}"
                      data-refinfo5="{{ $caseassetrefinfo5 }}" data-refinfo8="{{ $caseassetrefinfo8 }}" data-refinfo1="{{ $caseassetrefinfo1 }}" data-refinfo7="{{ $caseassetrefinfo7 }}" data-refinfo9="{{ $caseassetrefinfo9 }}"
                      data-refinfo10="{{ $caseassetrefinfo10 }}"data-refinfo11="{{ $caseassetrefinfo11 }}"data-refinfo12="{{ $caseassetrefinfo12 }}"data-refinfo13="{{ $caseassetrefinfo13 }}"data-refinfo14="{{ $caseassetrefinfo14 }}"
                      data-refinfo15="{{ $caseassetrefinfo15 }}"data-refinfo16="{{ $caseassetrefinfo16 }}"data-refinfo17="{{ $caseassetrefinfo17 }}"data-refinfo18="{{ $caseassetrefinfo18 }}"data-refinfo2="{{ $caseassetrefinfo2 }}"data-refinfo6="{{ $caseassetrefinfo6 }}"
                      data-refnamehead="{{$caseassetrefnamehead}}" data-refinfohead3="{{ $caseassetrefinfohead3 }}" data-refinfohead4="{{ $caseassetrefinfohead4 }}"
                      data-refinfohead5="{{ $caseassetrefinfohead5 }}" data-refinfohead8="{{ $caseassetrefinfohead8 }}" data-refinfohead1="{{ $caseassetrefinfohead1 }}" data-refinfohead7="{{ $caseassetrefinfohead7 }}" data-refinfohead9="{{ $caseassetrefinfohead9 }}"
                      data-refinfohead10="{{ $caseassetrefinfohead10 }}"  data-refinfohead11="{{ $caseassetrefinfohead11 }}"data-refinfohead12="{{ $caseassetrefinfohead12 }}"data-refinfohead13="{{ $caseassetrefinfohead13 }}"data-refinfohead14="{{ $caseassetrefinfohead14 }}"
                      data-refinfohead15="{{ $caseassetrefinfohead15 }}"data-refinfohead16="{{ $caseassetrefinfohead16 }}"data-refinfohead17="{{ $caseassetrefinfohead17 }}"data-refinfohead18="{{ $caseassetrefinfohead18 }}"data-refinfohead2="{{ $caseassetrefinfohead2 }}"data-refinfohead6="{{ $caseassetrefinfohead6 }}">
                    </div>
                    <div class="" id="casepaymentuser" data-id="{{ $id }}" data-varvalue10="{{$casetrackingvarvalue10 }}" data-varvalue9="{{$casetrackingvarvalue9 }}" data-varvalue8="{{$casetrackingvarvalue8 }}" data-varname28="{{ $casevarname28 }}" data-varname29="{{ $casevarname29 }}" data-varname51="{{ $casevarname51 }}"
                      data-varname52="{{ $casevarname52 }}" data-varname53="{{ $casevarname53 }}" data-varname26="{{ $casevarname26 }}" data-varname27="{{ $casevarname27 }}" data-varname30="{{ $casevarname30 }}" data-varname31="{{ $casevarname31 }}"
                      data-varname32="{{ $casevarname32 }}" data-varname33="{{ $casevarname33}}" data-varname34="{{ $casevarname34 }}" data-varname35="{{ $casevarname35 }}" data-varname36="{{ $casevarname36 }}" data-varname37="{{ $casevarname37 }}"
                      data-varvalue28="{{ $casevarvalue28 }}" data-varvalue51="{{ $casevarvalue51 }}" data-varvalue52="{{ $casevarvalue52 }}" data-varvalue53="{{ $casevarvalue53 }}" data-varvalue26="{{ $casevarvalue26 }}"
                      data-varvalue27="{{ $casevarvalue27 }}" data-varvalue29="{{ $casevarvalue29 }}" data-varvalue30="{{ $casevarvalue30 }}" data-varvalue31="{{ $casevarvalue31 }}" data-varvalue32="{{ $casevarvalue32 }}"
                      data-varvalue33="{{ $casevarvalue33}}" data-varvalue34="{{ $casevarvalue34 }}" data-varvalue35="{{ $casevarvalue35 }}" data-varvalue36="{{ $casevarvalue36 }}" data-varvalue37="{{ $casevarvalue37 }}"
                      data-insurancecompanyname="{{ $offerinsurancecompany }}" data-insurancepremium="{{ $offerinsurancepaymentpremium }}" data-insurancetaxdeduction="{{ $offerinsurancepaymenttaxdeduction }}"
                      data-alldiscountinsurance="{{ $alldiscountinsurance }}" data-calculatebeforetaxdeductinsurance="{{ $calculatebeforetaxdeductinsurance }}" data-calculatebeforetaxdeductinsurance="{{ $calculatebeforetaxdeductinsurance }}"
                      data-calculateaftertaxdeductinsurance="{{ $calculateaftertaxdeductinsurance }}" data-totalpaidpartnerinsurance="{{ $totalpaidpartnerinsurance }}" data-totalpaiduserinsurance="{{ $totalpaiduserinsurance }}"
                      data-totalpaidcompanyinsurance="{{ $totalpaidcompanyinsurance }}" data-insurancecopypaymentfilepublicname="{{ $offerinsurancecopypaymentfilepublicname }}" data-insurancecopypaymentfileid="{{ $offerinsurancecopypaymentfileid }}"
                      data-insurancepaymenttocompanycopyfileid="{{ $offerinsurancepaymenttocompanycopyfileid }}" data-insurancepaymenttocompanycopyfilepublicname="{{ $offerinsurancepaymenttocompanycopyfilepublicname }}"
                      data-actcompanyname="{{ $offeractcompany }}" data-insurancepremium="{{ $offeractpaymentpremium }}" data-acttaxdeduction="{{ $offeractpaymenttaxdeduction }}" data-alldiscountact="{{ $alldiscountact }}"
                      data-calculatebeforetaxdeductact="{{ $calculatebeforetaxdeductact }}" data-calculatebeforetaxdeductact="{{ $calculatebeforetaxdeductact }}" data-calculateaftertaxdeductact="{{ $calculateaftertaxdeductact }}"
                      data-totalpaidpartneract="{{ $totalpaidpartneract }}" data-totalpaiduseract="{{ $totalpaiduseract }}" data-totalpaidcompanyact="{{ $totalpaidcompanyact }}"
                      data-actcopypaymentfilepublicname="{{ $offeractcopypaymentfilepublicname }}" data-actcopypaymentfileid="{{ $offeractcopypaymentfileid }}" data-actpaymenttocompanycopyfileid="{{ $offeractpaymenttocompanycopyfileid }}"
                      data-actpaymenttocompanycopyfilepublicname="{{ $offeractpaymenttocompanycopyfilepublicname }}" data-taxcompanyname="{{ $offertaxcompany }}" data-insurancepremium="{{ $offertaxpaymentpremium }}"
                      data-taxtaxdeduction="{{ $offertaxpaymenttaxdeduction }}" data-alldiscounttax="{{ $alldiscounttax }}" data-calculatebeforetaxdeducttax="{{ $calculatebeforetaxdeducttax }}"
                      data-calculatebeforetaxdeducttax="{{ $calculatebeforetaxdeducttax }}" data-calculateaftertaxdeducttax="{{ $calculateaftertaxdeducttax }}" data-totalpaidpartnertax="{{ $totalpaidpartnertax }}"
                      data-totalpaidusertax="{{ $totalpaidusertax }}" data-totalpaidcompanytax="{{ $totalpaidcompanytax }}" data-taxcopypaymentfilepublicname="{{ $offertaxcopypaymentfilepublicname }}"
                      data-taxcopypaymentfileid="{{ $offertaxcopypaymentfileid }}" data-taxpaymenttocompanycopyfileid="{{ $offertaxpaymenttocompanycopyfileid }}"
                      data-taxpaymenttocompanycopyfilepublicname="{{ $offertaxpaymenttocompanycopyfilepublicname }}" data-allpremium="{{ $allpremium }}" data-alltaxdeduct="{{ $alltaxdeduct }}" data-alldiscount="{{ $alldiscount }}"
                      data-allcalculatebeforetaxdeduct="{{ $allcalculatebeforetaxdeduct }}" data-allcalculateaftertaxdeduct="{{ $allcalculateaftertaxdeduct }}" data-alltotalpaidpartner="{{ $alltotalpaidpartner }}"
                      data-alltotalpaiduser="{{ $alltotalpaiduser }}" data-alltotalpaidcompany="{{ $alltotalpaidcompany }}" data-varname5="{{$casevarname5}}" data-varname6="{{$casetrackingvarname6 }}" data-varname7="{{$casetrackingvarname7 }}"
                      datra-varvalue5="{{$casetrackingvarvalue5 }}" data-varvalue6="{{$casetrackingvarvalue6 }}" data-varvalue7="{{$casetrackingvarvalue7 }}" data-varname17="{{ $casetrackingvarname17 }}" data-varname18="{{ $casetrackingvarname18 }}"
                      data-varname19="{{ $casetrackingvarname19 }}" data-varvalue17="{{$casetrackingvarvalue17 }}" data-varvalue18="{{$casetrackingvarvalue18 }}" data-varvalue19="{{$casetrackingvarvalue19 }}"
                      data-varname51="{{$casetrackingvarname51 }}" data-varname52="{{$casetrackingvarname52 }}" data-varname53="{{$casetrackingvarname53 }}" data-varvalue51="{{$casetrackingvarvalue51 }}" data-varvalue52="{{$casetrackingvarvalue52 }}"
                      data-varvalue53="{{$casetrackingvarvalue53 }}">
                    </div>

                  </div>
                  <div class="column" id="filemain">
                    <div class="box collapsed-box" style="background-color:'#F5F5F5'">
                      <div class="box-header  ">
                        <b class="box-title" data-widget="collapse">เอกสารหลัก/เอกสารประกอบ</b>
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div>
                      </div>
                      <div class="box-body">

                        <div class="card">
                          <div class="card-header">เอกสารหลัก
                            <div class="box-tools pull-right">
                              <button style="display:none" type="button" class="btn btn-box-tool"><i class="fa fa-plus"></i></button>
                            </div>
                          </div>
                          <div class="card-body">
                            <div class="column">
                              <div class="column3">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                  <thead>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:50%;height:60px">สำเนาบัตรประจำตัวประชาชน</th>
                                      @if(count($citizenfile) >0)
                                      <th style="background-color:#72EB00">
                                        @foreach($citizenfile as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a
                                          href="https://erp.wealththai.net/SecurityBroke/member/uploadfile/{{$memberid}}/xxx/CG3CG/Member_Attachment_{{$memberid}}?cat?CA9CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink" target="_blank"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:200px;height:60px">สำเนาบัตรประจำตัวใบขับขี่</th>
                                      @if(count($driverfile) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($driverfile as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a
                                          href="https://erp.wealththai.net/SecurityBroke/member/uploadfile/{{$memberid}}/xxx/CG3CG/Member_Attachment_{{$memberid}}?cat?CA11CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:200px;height:60px">สำเนาบัตรพนักงาน</th>
                                      @if(count($employeefile) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($employeefile as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a
                                          href="https://erp.wealththai.net/SecurityBroke/member/uploadfile/{{$memberid}}/xxx/CG3CG/Member_Attachment_{{$memberid}}?cat?CA31CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>

                                  </thead>
                                </table>
                              </div>
                              <div class="column3">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                  <thead>

                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:200px;height:60px">สลิปเงินเดือน /Salary Slip</th>
                                      @if(count($salaryslipfile) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($salaryslipfile as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a
                                          href="https://erp.wealththai.net/SecurityBroke/member/uploadfile/{{$memberid}}/xxx/CG3CG/Member_Attachment_{{$memberid}}?cat?CA32CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:50%;height:60px">สำเนาหน้าเล่มรถ</th>
                                      @if(count($carfile) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($carfile as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a
                                          href="https://erp.wealththai.net/SecurityBroke/asset/uploadfile/{{$portid}}/{{$assetid}}/xxx/CG2CG/Asset_Attachment_{{$portid}}_{{$assetid}}?cat?CA15CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:50%;height:60px">สำเนากรมธรรม์เดิม (ก่อนทำกับเรา)</th>
                                      @if(count($oldinsurances) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($oldinsurances as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a href="https://erp.wealththai.net/SecurityBroke/case/uploadfile/{{$id}}/xxx/CG4CG/Case_Attachment?cat?CA36CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                  </thead>
                                </table>
                              </div>
                              <div class="column3">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                  <thead>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:50%;height:60px">สำเนาพรบเดิม (ก่อนทำกับเรา)</th>
                                      @if(count($oldact) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($oldact as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a href="https://erp.wealththai.net/SecurityBroke/case/uploadfile/{{$id}}/xxx/CG4CG/Case_Attachment?cat?CA37CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:50%;height:60px">สำเนาภาษีเดิม (ก่อนทำกับเรา)</th>
                                      @if(count($oldtax) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($oldtax as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a href="https://erp.wealththai.net/SecurityBroke/case/uploadfile/{{$id}}/xxx/CG4CG/Case_Attachment?cat?CA38CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:50%;height:60px">ใบรับเงินประกันแทน</th>
                                      @if(count($moneystandin) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($moneystandin as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a href="https://erp.wealththai.net/SecurityBroke/case/uploadfile/{{$id}}/xxx/CG4CG/Case_Attachment?cat?CA42CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                  </thead>
                                </table>
                              </div>
                            </div>
                            <div class="column">
                              <div class="column3">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                  <thead>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:50%;height:60px">ใบผลตรวจสภาพรถ</th>
                                      @if(count($guaranteereceipt) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($guaranteereceipt as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a href="https://erp.wealththai.net/SecurityBroke/case/uploadfile/{{$id}}/xxx/CG4CG/Case_Attachment?cat?CA39CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:50%;height:60px">บัตรส่วนลด(Coupon)</th>
                                      @if(count($discountcoupon) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($discountcoupon as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a href="https://erp.wealththai.net/SecurityBroke/case/uploadfile/{{$id}}/xxx/CG4CG/Case_Attachment?cat?CA40CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:50%;height:60px">สำเนาใบเตือนต่ออายุ </th>
                                      @if(count($copyrenewnotice) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($copyrenewnotice as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a href="https://erp.wealththai.net/SecurityBroke/case/uploadfile/{{$id}}/xxx/CG4CG/Case_Attachment?cat?CA43CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                  </thead>
                                </table>
                              </div>
                              <div class="column3">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                  <thead>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:50%;height:60px">ใบคำขอเอาประกันภัย</th>
                                      @if(count($insuranceapplication) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($insuranceapplication as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a href="https://erp.wealththai.net/SecurityBroke/case/uploadfile/{{$id}}/xxx/CG4CG/Case_Attachment?cat?CA41CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:50%;height:60px">สำเนารับรองบริษัท</th>
                                      @if(count($companycopy) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($companycopy as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a href="https://erp.wealththai.net/SecurityBroke/case/uploadfile/{{$id}}/xxx/CG3CG/Member_Attachment?cat?CA20CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:50%;height:60px">หนังสือรับรองทะเบียนการค้า</th>
                                      @if(count($commercialcert) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($commercialcert as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a href="https://erp.wealththai.net/SecurityBroke/case/uploadfile/{{$id}}/xxx/CG3CG/Member_Attachment?cat?CA28CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                  </thead>
                                </table>
                              </div>
                              <div class="column3">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                  <thead>
                                    <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                      <th style="background-color:#F4F4F6;width:50%;height:60px">สำเนาบัตรกรรมการ</th>
                                      @if(count($departmentcopy) >0 )
                                      <th style="background-color:#72EB00">
                                        @foreach($departmentcopy as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                        @endforeach</th>
                                          @else
                                      <th style="background-color:white"><a href="https://erp.wealththai.net/SecurityBroke/case/uploadfile/{{$id}}/xxx/CG3CG/Member_Attachment?cat?CA22CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                          class="btn btn-default">อัพโหลด</a></th>
                                      @endif
                                    </tr>
                                  </thead>
                                </table>
                              </div>
                            </div>
                          </div>

                        </div>
                        <br />

                        <div class="card">
                          <div class="card-header">เอกสารประกอบ </div>
                          <div class="card-body">
                            <div class="column3">
                              <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                  <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                    <th style="background-color:#F4F4F6;width:50%;height:40px">รูปรถยนต์</th>
                                    @if(count($carphoto) >0 )
                                    <th style="background-color:#72EB00">
                                      @foreach($carphoto as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                      @endforeach</th>
                                        @else
                                    <th style="background-color:white"><a
                                        href="https://erp.wealththai.net/SecurityBroke/asset/uploadfile/{{$portid}}/{{$assetid}}/xxx/CG2CG/Asset_Attachment_{{$portid}}_{{$assetid}}?cat?CA14CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                        class="btn btn-default">อัพโหลด</a></th>
                                    @endif
                                  </tr>
                                  <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                    <th style="background-color:#F4F4F6;width:50%;height:40px">รููปกล้องติดรถยนต์</th>
                                    @if(count($carcamera) >0 )
                                    <th style="background-color:#72EB00">
                                      @foreach($carcamera as $data) <a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                      @endforeach</th>
                                        @else
                                    <th style="background-color:white"><a
                                        href="https://erp.wealththai.net/SecurityBroke/asset/uploadfile/{{$portid}}/{{$assetid}}/xxx/CG2CG/Asset_Attachment_{{$portid}}_{{$assetid}}?cat?CA44CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink"
                                        class="btn btn-default">อัพโหลด</a></th>
                                    @endif
                                  </tr>
                                </thead>
                              </table>
                            </div>
                            <div class="columnanotherfile">
                              <table id="example2" class="table  table-hover dataTable " role="grid" aria-describedby="example2_info">
                                <thead>
                                  <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                    <th style="background-color:#F4F4F6;width:200px;height:55px">เอกสารอื่นๆ <a style="float:right"
                                        href="https://erp.wealththai.net/SecurityBroke/case/uploadfile/{{$id}}/xxx/CG4CG/Case_Attachment?cat?CA53CA/blink/wealththaiinsurance/cases/{{$id}}/detail/showblink" class="btn btn-default">อัพโหลด</a></th>
                                  </tr>
                                  <tr style="border:'0.5px solid #E3E3E3';background-color:'#F4F4F6'">
                                    <th style="background-color:white">
                                      @foreach($anotherfile as $data)<a href="/SecurityBroke/showfile/{{$data->id}}" target="_blank">{{$data->file_public_name}}</a>
                                      @endforeach</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <div class="tablescroll">

                                    <tr>
                                    </tr>

                                  </div>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>


                      </div>
                    </div>
                  </div>


                </div>
                <div class="column">
                  <div class="box collapsed-box" style="background-color:'#F5F5F5'">
                    <div class="box-header  ">
                      <b class="box-title" data-widget="collapse">ขั้นตอนงาน / Case Log</b>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <div style="overflow-x:'auto'">
                        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                          <thead>
                            <tr role="row">
                              <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">วันที่ </th>
                              <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">จากขั้นตอน </th>
                              <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending"> </th>
                              <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ถึงขั้นตอน </th>
                              <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">เงื่อนไขที่ผ่าน </th>

                            </tr>
                          </thead>
                          <tbody>
                            @foreach($caselog as $casel)
                            <tr>
                              <td>{{$casel->date_time}}</td>
                              @if($casel->move_from_stage == NULL || $casel->move_from_stage == 0 || $casel->move_from_stage =='' )
                                <td></td>
                                @else
                                <td>{{$casel->movefromstage->name}}</td>
                                @endif
                                <td style="text-align:center;font-size:22px;color:green"><i class="fa fa-long-arrow-right"></i></td>
                                @if($casel->move_to_stage == NULL || $casel->move_to_stage == 0 || $casel->move_to_stage =='' )
                                  <td></td>
                                  @else
                                  <td>{{$casel->movetostage->name}}</td>
                                  @endif
                                  @php
                                  $casecondition = \App\Case_condition::with(['path_condition_detail'])->where('current_stage',$casel->move_from_stage)->where('condition_flag',1)->where('case_id',$casel->id)->get();
                                  @endphp
                                  <td>
                                    @foreach($casecondition as $index =>$casec)<p>{{++$index}}{{$casec->path_condition_detail->name}} {{$casec->date_time}}</p>
                                    @endforeach</td>

                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="column">
                  <div class="box collapsed-box" style="background-color:'#F5F5F5'">
                    <div class="box-header  ">
                      <b class="box-title" data-widget="collapse">Stage Action Log</b>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                          <tr role="row">

                            <th>ขั้นตอนงาน</th>
                            <th>Action</th>
                            <th>เวลา</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($caseaction as $caseac)
                          <tr>
                            <td>{{$caseac->stage->name}}</td>
                            <td>{{$caseac->stageaction->name}}</td>
                            <td>{{$caseac->time}}</td>

                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>




                {{--}}
                <div id="insuranceshowdetail" data-id="{{ $id }}" data-name="{{ $name }}" data-cases="{{ $cases }}">
                </div>--}}
              </div>
            </div>
            <script src="{{ asset ("/js/app.js") }}" type="text/javascript"></script>

          </div>
        </div>
        <!-- /.box-body -->
        <div style="overflow-x:auto;">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">

                <th colspan="100"> ข้อเสนอที่แนะนำ <a href='/wealththaiinsurance/casesuser/{{$id}}/offer/show?blink{{$url}}'>ดูข้อเสนอทั้งหมด</a> </th>


              </tr>
              <tr role="row">

                <th colspan="5"> </th>
                <th colspan="5" style="text-align:'center';background-color:" silver"">ทุนประกัน </th>
                <th colspan="5" style="text-align:'center';background-color:" silver"">ความเสียหายต่อทรัพย์สิน</th>
              </tr>
              <tr role="row">
                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">AI </th>
                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ชื่อข้อเสนอ </th>
                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ประเภทข้อเสนอ</th>
                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">บริษัท</th>
                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">สาขา</th>
                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{{$offertypefromoffercat->offer_value_name5}}</th>
                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{{$offertypefromoffercat->offer_value_name6}}</th>
                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{{$offertypefromoffercat->offer_value_name7}} </th>
                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{{$offertypefromoffercat->offer_value_name1}}</th>
                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{{$offertypefromoffercat->offer_value_name14}}</th>
                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{{$offertypefromoffercat->offer_value_name19}}</th>
                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{{$offertypefromoffercat->offer_value_name2}}</th>
                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{{$offertypefromoffercat->offer_value_name3}}</th>
                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{{$offertypefromoffercat->offer_value_name4}}</th>

                <th aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($confirmoffer as $c)
              <tr style="background-color:#72EB00">
                <td></td>
                <td>{{$c->name}}</td>
                @if($c->type_id == NULL ||$c->type_id == ''||$c->type_id == 0)
                  <td></td>
                  @else
                  <td>{{$c->OfferType->name}}</td>
                  @endif
                  @if($c->ref_member_id == NULL ||$c->ref_member_id == ''||$c->ref_member_id == 0)
                    <td></td>
                    @else
                    <td>{{$c->Person->name}}</td>
                    @endif
                    @if($c->ref_branch_id == NULL ||$c->ref_branch_id == ''||$c->ref_branch_id == 0)
                      <td></td>
                      @else
                      <td>{{$c->branch->name}}</td>
                      @endif
                      <td>{{$c->offer_value5}}</td>
                      <td>{{$c->offer_value6}}</td>
                      <td>{{$c->offer_value7}}</td>
                      <td>{{$c->offer_value1}}</td>
                      <td>{{$c->offer_value14}}</td>
                      <td>{{$c->offer_value19}}</td>
                      <td>{{$c->offer_value2}}</td>
                      <td>{{$c->offer_value3}}</td>
                      <td>{{$c->offer_value4}}</td>
                      <td>
                        <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{ $c->id }}">รายละเอียด</button>
                        <div class="modal" id="myModal{{ $c->id }}" role="dialog">
                          <div class="modal-dialog modal-lg ">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button style="float:right" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <h3 class="modal-title">{{$c->name}}</h3>
                                <p class="modal-title">
                                  <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home{{ $c->id }}">รายละเอียดข้อเสนอ</a></li>
                                  </ul>
                                </p>
                              </div>
                              <div class="modal-body">

                                <div class="tab-content" style="padding:10px">
                                  <div id="home{{$c->id}}" class="tab-pane  in active">
                                    <table class="table table-bordered table-hover" style="width:100%;color:black">
                                      <tr>
                                        <th width="">
                                          <p>ชื่อข้อเสนอ</p>
                                        </th>
                                        <td>{{ $c->name }}</td>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ประเภทข้อเสนอ</p>
                                        </th>
                                        <th>{{ $c->OfferType->name }}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>วันที่สร้าง</p>
                                        </th>
                                        <th>{{ $c->created_date }} </th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>วันที่แก้ไขล่าสุด</p>
                                        </th>
                                        <th>{{ $c->modified_date }} </th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>คนสร้าง</p>
                                        </th>
                                        <th>{{ $c->match_id->public_name }} </th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>บริษัท</p>
                                        </th>
                                        <td>{{ $c->Person->name }}</td>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>สาขา</p>
                                        </th>
                                        @if($c->ref_branch_id == NULL ||$c->ref_branch_id == ''||$c->ref_branch_id == 0)
                                          <td></td>
                                          @else
                                          <td>{{ $c->branch->name }}</td>

                                          @endif
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name1 }} </p>
                                        </th>
                                        <th>{{ $c->offer_value1 }}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name2}} </p>
                                        </th>
                                        <th>{{ $c->offer_value2}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name3}} </p>
                                        </th>
                                        <th>{{ $c->offer_value3}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name4}} </p>
                                        </th>
                                        <th>{{ $c->offer_value4}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name5}} </p>
                                        </th>
                                        <th>{{ $c->offer_value5}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name6}} </p>
                                        </th>
                                        <th>{{ $c->offer_value6}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name7}} </p>
                                        </th>
                                        <th>{{ $c->offer_value7}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name8}} </p>
                                        </th>
                                        <th>{{ $c->offer_value8}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name9}} </p>
                                        </th>
                                        <th>{{ $c->offer_value9}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name10}} </p>
                                        </th>
                                        <th>{{ $c->offer_value10}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name11}} </p>
                                        </th>
                                        <th>{{ $c->offer_value11}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name12}} </p>
                                        </th>
                                        <th>{{ $c->offer_value12}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name13}} </p>
                                        </th>
                                        <th>{{ $c->offer_value13}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name14}} </p>
                                        </th>
                                        <th>{{ $c->offer_value14}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name15}} </p>
                                        </th>
                                        <th>{{ $c->offer_value15}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name16}} </p>
                                        </th>
                                        <th>{{ $c->offer_value16}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name17}} </p>
                                        </th>
                                        <th>{{ $c->offer_value17}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name18}} </p>
                                        </th>
                                        <th>{{ $c->offer_value18}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name19}} </p>
                                        </th>
                                        <th>{{ $c->offer_value19}}</th>
                                      </tr>
                                      @if($c->OfferType->offer_value_name20 == NULL || $c->OfferType->offer_value_name20 ==''||$c->OfferType->offer_value_name20 == 0)
                                        @else
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name20}} </p>
                                          </th>
                                          <th>{{ $c->offer_value20}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name21}} </p>
                                          </th>
                                          <th>{{ $c->offer_value21}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name22}} </p>
                                          </th>
                                          <th>{{ $c->offer_value22}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name23}} </p>
                                          </th>
                                          <th>{{ $c->offer_value23}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name24}} </p>
                                          </th>
                                          <th>{{ $c->offer_value24}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name25}} </p>
                                          </th>
                                          <th>{{ $c->offer_value25}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name26}} </p>
                                          </th>
                                          <th>{{ $c->offer_value26}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name27}} </p>
                                          </th>
                                          <th>{{ $c->offer_value27}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name28}} </p>
                                          </th>
                                          <th>{{ $c->offer_value28}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name29}} </p>
                                          </th>
                                          <th>{{ $c->offer_value29}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name30}} </p>
                                          </th>
                                          <th>{{ $c->offer_value30}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name31}} </p>
                                          </th>
                                          <th>{{ $c->offer_value31}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name32}} </p>
                                          </th>
                                          <th>{{ $c->offer_value32}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name33}} </p>
                                          </th>
                                          <th>{{ $c->offer_value33}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name34}} </p>
                                          </th>
                                          <th>{{ $c->offer_value34}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name35}} </p>
                                          </th>
                                          <th>{{ $c->offer_value35}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name36}} </p>
                                          </th>
                                          <th>{{ $c->offer_value36}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name37}} </p>
                                          </th>
                                          <th>{{ $c->offer_value37}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name38}} </p>
                                          </th>
                                          <th>{{ $c->offer_value38}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name39}} </p>
                                          </th>
                                          <th>{{ $c->offer_value39}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name40}} </p>
                                          </th>
                                          <th>{{ $c->offer_value40}}</th>
                                        </tr>
                                        @endif
                                    </table>
                                  </div>
                                  <div id="menu1{{$c->id}}" class="tab-pane ">
                                    <table class="table table-bordered table-hover" style="width:100%;color:black">

                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name1}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value1}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name2}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value2}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name3}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value3}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name4}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value4}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name5}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value5}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name6}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value6}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name7}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value7}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name8}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value8}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name9}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value9}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name10}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value10}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name11}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value11}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name12}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value12}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name13}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value13}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name14}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value14}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name15}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value15}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name16}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value16}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name17}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value17}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name18}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value18}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name19}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value19}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name20}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value20}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name21}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value21}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name22}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value22}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name23}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value23}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name24}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value24}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name25}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value25}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name26}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value26}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name27}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value27}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name28}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value28}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name29}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value29}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name30}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value30}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name31}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value31}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name32}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value32}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name33}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value33}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name34}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value34}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name35}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value35}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name36}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value36}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name37}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value37}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name38}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value38}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name39}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value39}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name40}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value40}}</th>
                                      </tr>
                                    </table>
                                  </div>
                                  <div id="menu2{{$c->id}}" class="tab-pane ">
                                    <table class="table table-bordered table-hover" style="width:100%;color:black">

                                      <tr>
                                        <th width="">
                                          <p>เบี้ยรวมหน้าตั๋ว</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ส่วนลดพิเศษทั้งหมด </p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย (Customer)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย (Customer)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท (Partner) </p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท (User)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
              </tr>
              @endforeach
              @foreach($interestoffer as $c)
              <tr style="background-color:yellow">
                <td></td>
                <td>{{$c->name}}</td>
                @if($c->type_id == NULL ||$c->type_id == ''||$c->type_id == 0)
                  <td></td>
                  @else
                  <td>{{$c->OfferType->name}}</td>
                  @endif
                  @if($c->ref_member_id == NULL ||$c->ref_member_id == ''||$c->ref_member_id == 0)
                    <td></td>
                    @else
                    <td>{{$c->Person->name}}</td>
                    @endif
                    @if($c->ref_branch_id == NULL ||$c->ref_branch_id == ''||$c->ref_branch_id == 0)
                      <td></td>
                      @else
                      <td>{{$c->branch->name}}</td>
                      @endif
                      <td>{{$c->offer_value5}}</td>
                      <td>{{$c->offer_value6}}</td>
                      <td>{{$c->offer_value7}}</td>
                      <td>{{$c->offer_value1}}</td>
                      <td>{{$c->offer_value14}}</td>
                      <td>{{$c->offer_value19}}</td>
                      <td>{{$c->offer_value2}}</td>
                      <td>{{$c->offer_value3}}</td>
                      <td>{{$c->offer_value4}}</td>
                      <td>
                        <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{ $c->id }}">รายละเอียด</button>
                        <div class="modal" id="myModal{{ $c->id }}" role="dialog">
                          <div class="modal-dialog modal-lg ">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button style="float:right" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <h3 class="modal-title">{{$c->name}}</h3>
                                <p class="modal-title">
                                  <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home{{ $c->id }}">รายละเอียดข้อเสนอ</a></li>
                                    <li><a data-toggle="tab" href="#menu2{{ $c->id }}">รายละเอียดการชำระเงิน</a></li>
                                  </ul>
                                </p>
                              </div>
                              <div class="modal-body">

                                <div class="tab-content" style="padding:10px">
                                  <div id="home{{$c->id}}" class="tab-pane  in active">
                                    <table class="table table-bordered table-hover" style="width:100%;color:black">
                                      <tr>
                                        <th width="">
                                          <p>ชื่อข้อเสนอ</p>
                                        </th>
                                        <td>{{ $c->name }}</td>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ประเภทข้อเสนอ</p>
                                        </th>
                                        <th>{{ $c->OfferType->name }}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>วันที่สร้าง</p>
                                        </th>
                                        <th>{{ $c->created_date }} </th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>วันที่แก้ไขล่าสุด</p>
                                        </th>
                                        <th>{{ $c->modified_date }} </th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>คนสร้าง</p>
                                        </th>
                                        <th>{{ $c->match_id->public_name }} </th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>บริษัท</p>
                                        </th>
                                        <td>{{ $c->Person->name }}</td>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>สาขา</p>
                                        </th>
                                        @if($c->ref_branch_id == NULL ||$c->ref_branch_id == ''||$c->ref_branch_id == 0)
                                          <td></td>
                                          @else
                                          <td>{{ $c->branch->name }}</td>
                                          @endif
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name1 }} </p>
                                        </th>
                                        <th>{{ $c->offer_value1 }}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name2}} </p>
                                        </th>
                                        <th>{{ $c->offer_value2}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name3}} </p>
                                        </th>
                                        <th>{{ $c->offer_value3}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name4}} </p>
                                        </th>
                                        <th>{{ $c->offer_value4}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name5}} </p>
                                        </th>
                                        <th>{{ $c->offer_value5}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name6}} </p>
                                        </th>
                                        <th>{{ $c->offer_value6}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name7}} </p>
                                        </th>
                                        <th>{{ $c->offer_value7}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name8}} </p>
                                        </th>
                                        <th>{{ $c->offer_value8}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name9}} </p>
                                        </th>
                                        <th>{{ $c->offer_value9}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name10}} </p>
                                        </th>
                                        <th>{{ $c->offer_value10}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name11}} </p>
                                        </th>
                                        <th>{{ $c->offer_value11}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name12}} </p>
                                        </th>
                                        <th>{{ $c->offer_value12}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name13}} </p>
                                        </th>
                                        <th>{{ $c->offer_value13}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name14}} </p>
                                        </th>
                                        <th>{{ $c->offer_value14}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name15}} </p>
                                        </th>
                                        <th>{{ $c->offer_value15}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name16}} </p>
                                        </th>
                                        <th>{{ $c->offer_value16}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name17}} </p>
                                        </th>
                                        <th>{{ $c->offer_value17}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name18}} </p>
                                        </th>
                                        <th>{{ $c->offer_value18}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name19}} </p>
                                        </th>
                                        <th>{{ $c->offer_value19}}</th>
                                      </tr>
                                      @if($c->OfferType->offer_value_name20 == NULL || $c->OfferType->offer_value_name20 ==''||$c->OfferType->offer_value_name20 == 0)
                                        @else
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name20}} </p>
                                          </th>
                                          <th>{{ $c->offer_value20}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name21}} </p>
                                          </th>
                                          <th>{{ $c->offer_value21}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name22}} </p>
                                          </th>
                                          <th>{{ $c->offer_value22}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name23}} </p>
                                          </th>
                                          <th>{{ $c->offer_value23}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name24}} </p>
                                          </th>
                                          <th>{{ $c->offer_value24}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name25}} </p>
                                          </th>
                                          <th>{{ $c->offer_value25}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name26}} </p>
                                          </th>
                                          <th>{{ $c->offer_value26}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name27}} </p>
                                          </th>
                                          <th>{{ $c->offer_value27}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name28}} </p>
                                          </th>
                                          <th>{{ $c->offer_value28}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name29}} </p>
                                          </th>
                                          <th>{{ $c->offer_value29}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name30}} </p>
                                          </th>
                                          <th>{{ $c->offer_value30}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name31}} </p>
                                          </th>
                                          <th>{{ $c->offer_value31}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name32}} </p>
                                          </th>
                                          <th>{{ $c->offer_value32}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name33}} </p>
                                          </th>
                                          <th>{{ $c->offer_value33}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name34}} </p>
                                          </th>
                                          <th>{{ $c->offer_value34}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name35}} </p>
                                          </th>
                                          <th>{{ $c->offer_value35}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name36}} </p>
                                          </th>
                                          <th>{{ $c->offer_value36}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name37}} </p>
                                          </th>
                                          <th>{{ $c->offer_value37}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name38}} </p>
                                          </th>
                                          <th>{{ $c->offer_value38}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name39}} </p>
                                          </th>
                                          <th>{{ $c->offer_value39}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name40}} </p>
                                          </th>
                                          <th>{{ $c->offer_value40}}</th>
                                        </tr>
                                        @endif
                                    </table>
                                  </div>
                                  <div id="menu1{{$c->id}}" class="tab-pane ">
                                    <table class="table table-bordered table-hover" style="width:100%;color:black">

                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name1}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value1}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name2}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value2}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name3}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value3}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name4}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value4}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name5}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value5}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name6}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value6}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name7}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value7}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name8}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value8}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name9}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value9}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name10}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value10}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name11}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value11}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name12}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value12}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name13}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value13}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name14}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value14}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name15}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value15}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name16}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value16}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name17}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value17}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name18}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value18}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name19}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value19}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name20}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value20}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name21}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value21}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name22}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value22}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name23}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value23}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name24}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value24}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name25}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value25}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name26}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value26}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name27}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value27}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name28}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value28}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name29}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value29}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name30}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value30}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name31}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value31}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name32}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value32}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name33}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value33}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name34}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value34}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name35}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value35}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name36}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value36}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name37}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value37}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name38}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value38}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name39}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value39}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name40}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value40}}</th>
                                      </tr>
                                    </table>
                                  </div>
                                  <div id="menu2{{$c->id}}" class="tab-pane ">
                                    <table class="table table-bordered table-hover" style="width:100%;color:black">

                                      <tr>
                                        <th width="">
                                          <p>เบี้ยรวมหน้าตั๋ว</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ส่วนลดพิเศษทั้งหมด </p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย (Customer)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย (Customer)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท (Partner) </p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท (User)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
              </tr>
              @endforeach
              @foreach($lastestoffer as $c)
              <tr style="background-color:yellow">
                <td></td>
                <td>{{$c->name}}</td>
                @if($c->type_id == NULL ||$c->type_id == ''||$c->type_id == 0)
                  <td></td>
                  @else
                  <td>{{$c->OfferType->name}}</td>
                  @endif
                  @if($c->ref_member_id == NULL ||$c->ref_member_id == ''||$c->ref_member_id == 0)
                    <td></td>
                    @else
                    <td>{{$c->Person->name}}</td>
                    @endif
                    @if($c->ref_branch_id == NULL ||$c->ref_branch_id == ''||$c->ref_branch_id == 0)
                      <td></td>
                      @else
                      <td>{{$c->branch->name}}</td>
                      @endif
                      <td>{{$c->offer_value5}}</td>
                      <td>{{$c->offer_value6}}</td>
                      <td>{{$c->offer_value7}}</td>
                      <td>{{$c->offer_value1}}</td>
                      <td>{{$c->offer_value14}}</td>
                      <td>{{$c->offer_value19}}</td>
                      <td>{{$c->offer_value2}}</td>
                      <td>{{$c->offer_value3}}</td>
                      <td>{{$c->offer_value4}}</td>
                      <td>
                        <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target="#myModal{{ $c->id }}">รายละเอียด</button>
                        <div class="modal" id="myModal{{ $c->id }}" role="dialog">
                          <div class="modal-dialog modal-lg ">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button style="float:right" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <h3 class="modal-title">{{$c->name}}</h3>
                                <p class="modal-title">
                                  <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home{{ $c->id }}">รายละเอียดข้อเสนอ</a></li>
                                    <li><a data-toggle="tab" href="#menu2{{ $c->id }}">รายละเอียดการชำระเงิน</a></li>
                                  </ul>
                                </p>
                              </div>
                              <div class="modal-body">

                                <div class="tab-content" style="padding:10px">
                                  <div id="home{{$c->id}}" class="tab-pane  in active">
                                    <table class="table table-bordered table-hover" style="width:100%;color:black">
                                      <tr>
                                        <th width="">
                                          <p>ชื่อข้อเสนอ</p>
                                        </th>
                                        <td>{{ $c->name }}</td>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ประเภทข้อเสนอ</p>
                                        </th>
                                        <th>{{ $c->OfferType->name }}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>วันที่สร้าง</p>
                                        </th>
                                        <th>{{ $c->created_date }} </th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>วันที่แก้ไขล่าสุด</p>
                                        </th>
                                        <th>{{ $c->modified_date }} </th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>คนสร้าง</p>
                                        </th>
                                        <th>{{ $c->match_id->public_name }} </th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>บริษัท</p>
                                        </th>
                                        <td>{{ $c->Person->name }}</td>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>สาขา</p>
                                        </th>
                                        @if($c->ref_branch_id == NULL ||$c->ref_branch_id == ''||$c->ref_branch_id == 0)
                                          <td></td>
                                          @else
                                          <td>{{ $c->branch->name }}</td>

                                          @endif
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name1 }} </p>
                                        </th>
                                        <th>{{ $c->offer_value1 }}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name2}} </p>
                                        </th>
                                        <th>{{ $c->offer_value2}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name3}} </p>
                                        </th>
                                        <th>{{ $c->offer_value3}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name4}} </p>
                                        </th>
                                        <th>{{ $c->offer_value4}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name5}} </p>
                                        </th>
                                        <th>{{ $c->offer_value5}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name6}} </p>
                                        </th>
                                        <th>{{ $c->offer_value6}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name7}} </p>
                                        </th>
                                        <th>{{ $c->offer_value7}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name8}} </p>
                                        </th>
                                        <th>{{ $c->offer_value8}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name9}} </p>
                                        </th>
                                        <th>{{ $c->offer_value9}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name10}} </p>
                                        </th>
                                        <th>{{ $c->offer_value10}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name11}} </p>
                                        </th>
                                        <th>{{ $c->offer_value11}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name12}} </p>
                                        </th>
                                        <th>{{ $c->offer_value12}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name13}} </p>
                                        </th>
                                        <th>{{ $c->offer_value13}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name14}} </p>
                                        </th>
                                        <th>{{ $c->offer_value14}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name15}} </p>
                                        </th>
                                        <th>{{ $c->offer_value15}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name16}} </p>
                                        </th>
                                        <th>{{ $c->offer_value16}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name17}} </p>
                                        </th>
                                        <th>{{ $c->offer_value17}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name18}} </p>
                                        </th>
                                        <th>{{ $c->offer_value18}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{ $c->OfferType->offer_value_name19}} </p>
                                        </th>
                                        <th>{{ $c->offer_value19}}</th>
                                      </tr>
                                      @if($c->OfferType->offer_value_name20 == NULL || $c->OfferType->offer_value_name20 ==''||$c->OfferType->offer_value_name20 == 0)
                                        @else
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name20}} </p>
                                          </th>
                                          <th>{{ $c->offer_value20}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name21}} </p>
                                          </th>
                                          <th>{{ $c->offer_value21}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name22}} </p>
                                          </th>
                                          <th>{{ $c->offer_value22}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name23}} </p>
                                          </th>
                                          <th>{{ $c->offer_value23}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name24}} </p>
                                          </th>
                                          <th>{{ $c->offer_value24}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name25}} </p>
                                          </th>
                                          <th>{{ $c->offer_value25}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name26}} </p>
                                          </th>
                                          <th>{{ $c->offer_value26}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name27}} </p>
                                          </th>
                                          <th>{{ $c->offer_value27}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name28}} </p>
                                          </th>
                                          <th>{{ $c->offer_value28}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name29}} </p>
                                          </th>
                                          <th>{{ $c->offer_value29}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name30}} </p>
                                          </th>
                                          <th>{{ $c->offer_value30}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name31}} </p>
                                          </th>
                                          <th>{{ $c->offer_value31}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name32}} </p>
                                          </th>
                                          <th>{{ $c->offer_value32}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name33}} </p>
                                          </th>
                                          <th>{{ $c->offer_value33}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name34}} </p>
                                          </th>
                                          <th>{{ $c->offer_value34}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name35}} </p>
                                          </th>
                                          <th>{{ $c->offer_value35}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name36}} </p>
                                          </th>
                                          <th>{{ $c->offer_value36}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name37}} </p>
                                          </th>
                                          <th>{{ $c->offer_value37}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name38}} </p>
                                          </th>
                                          <th>{{ $c->offer_value38}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name39}} </p>
                                          </th>
                                          <th>{{ $c->offer_value39}}</th>
                                        </tr>
                                        <tr>
                                          <th width="">
                                            <p>{{ $c->OfferType->offer_value_name40}} </p>
                                          </th>
                                          <th>{{ $c->offer_value40}}</th>
                                        </tr>
                                        @endif
                                    </table>
                                  </div>
                                  <div id="menu1{{$c->id}}" class="tab-pane ">
                                    <table class="table table-bordered table-hover" style="width:100%;color:black">

                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name1}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value1}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name2}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value2}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name3}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value3}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name4}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value4}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name5}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value5}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name6}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value6}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name7}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value7}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name8}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value8}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name9}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value9}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name10}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value10}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name11}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value11}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name12}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value12}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name13}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value13}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name14}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value14}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name15}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value15}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name16}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value16}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name17}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value17}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name18}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value18}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name19}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value19}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name20}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value20}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name21}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value21}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name22}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value22}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name23}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value23}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name24}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value24}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name25}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value25}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name26}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value26}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name27}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value27}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name28}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value28}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name29}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value29}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name30}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value30}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name31}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value31}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name32}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value32}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name33}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value33}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name34}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value34}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name35}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value35}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name36}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value36}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name37}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value37}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name38}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value38}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name39}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value39}}</th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>{{$c->OfferType->offer_payment_name40}} </p>
                                        </th>
                                        <th>{{$c->offer_payment_value40}}</th>
                                      </tr>
                                    </table>
                                  </div>
                                  <div id="menu2{{$c->id}}" class="tab-pane ">
                                    <table class="table table-bordered table-hover" style="width:100%;color:black">

                                      <tr>
                                        <th width="">
                                          <p>เบี้ยรวมหน้าตั๋ว</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ส่วนลดพิเศษทั้งหมด </p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย (Customer)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย (Customer)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท (Partner) </p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท (User)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                      <tr>
                                        <th width="">
                                          <p>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company)</p>
                                        </th>
                                        <th></th>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

</section>

@endsection

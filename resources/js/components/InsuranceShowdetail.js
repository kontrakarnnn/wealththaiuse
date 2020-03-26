import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import ReactTable from 'react-table'
import 'react-table/react-table.css'
import Dialog from 'react-dialog'
import Picky from 'react-picky';
import 'react-picky/dist/picky.css'; // Include CSS
import Modal from 'react-awesome-modal';

export default class InsuranceShowdetail extends Component {

  constructor(){
    super();
    //console.log(super());
    this.state = {
      day:[],
      month:[],
      year:[],
      cases:[],
      casesforclick:[],
      filcase:[],
      casecat:[],
      memberfile:[],
      citizenfile:[],
      driverfile:[],
      employeefile:[],
      salaryslipfile:[],
      oldinsurances:[],
      oldact:[],
      oldtax:[],
      vehicleinspection:[],
      discountcoupon:[],
      insuranceapplication:[],
      guaranteereceipt:[],
      copyrenewalnotice:[],
      carcamera:[],
      carfile:[],
      reload:[],
      reloadmemfileflag:0,
      flag:0,
      casefile:[],
      assetfile:[],
      carphoto:[],
      copyact:[],
      insurancecopy:[],
      insurancepaymenttocompanycopy:[],
      actpaymenttocompanycopy:[],
      taxpaymenttocompanycopy:[],
      taxcopy:[],
      caseid:'',
      offer:[],
      intertestoffer:[],
      lastestoffer:[],
      confirmoffer:[],
      casetrackingcolumn:0,
      casedetailcolumn:0,
      caseassetcolumn:0,
      casepaymentcolumn:0,
      refresh:'fa fa-refresh',
      refreshcarfile:'fa fa-refresh',
      alloffer:[],
      proposal:[],
      flagaddproposal:0,
      partnerblock:[],
      proposalname:'',
      partnerblockid:'',
      partnerblockname:'',
      description:'',
      proposalnameError:'',
      successmessage:'',
      proposalid:'',
      flagopeneditprop:0,
      arrayconfirmoffer:[],
      arrayconfirmofferid:[],
      chkbox:'checked',
      showalertmessage:'',
      classicviewflag:0,
      percentpromotion:'',
      discountcalculate:'',
      discountresult:'',
      calculatemode:0,
      clickofferforcal:'',
      clickedoffer:[],
      specialdiscount:'',
      allpremium:'',
      netpremium:'',
      discountpromo:'',
      discountcustomerlv:'',
      discountpartnerlv:'',
      discountuserlv:'',
      servicefee:'',
      servicefeeforcal:'',
      discountcompany:'',
      concludiscount:'',
      companymiss:'',
      oldprice:'',
      calpromotiontobaht:'',
      specialresult:'',
      allcalresult:'',
      promotionbath:'',
      netpremiumpromotion:'',
      netpremiumcustomerlv:'',
      netpremiumpartnerlv:'',
      netpremiumuserlv:'',
      netpremiumcompany:'',
      netpremiumcompanymiss:'',
      allpremiumflag:0,
      netpremiumflag:0,
      discountpromoflag:0,
      discountcustomerlvflag:0,
      discountpartnerlvflag:0,
      discountuserlvflag:0,
      discountcompanyflag:0,
      servicefeeflag:0,
      promotion:[],
      caselog:[],
      caseaction:[],
      showcaseconditionflag:0,
      caseconditionarray:[],
      fixact38:'',
      flagfixact38:0,
      fixact39:'',
      flagfixact39:0,
      fixact40:'',
      flagfixact40:0,
      fixins41:'',
      flagfixins41:0,
      fixins42:'',
      flagfixins42:0,
      fixins43:'',
      flagfixins43:0,
      fixtax44:'',
      flagfixtax44:0,
      fixtax45:'',
      flagfixtax45:0,
      fixtax46:'',
      flagfixtax46:0,
      visible : false,
      noteprevcase:'',
      flagnoteprevcase:0,
      notenextcase:'',
      flagnotenextcase:0,
      notefrommember:'',
      flagnotefrommember:0,
      notefrompartner:'',
      flagnotefrompartner:0,
      notefromuser:'',
      flagnotefromuser:0,
      day40:'',
      month40:'',
      year40:'',
      day43:'',
      month43:'',
      year43:'',
      day46:'',
      month46:'',
      year46:'',
      varvalue26:'',
      varvalue27:'',
      varvalue28:'',
      varvalue29:'',
      varvalue30:'',
      varvalue31:'',
      varvalue32:'',
      varvalue33:'',
      varvalue34:'',
      varvalue35:'',
      varvalue36:'',
      varvalue37:'',
      fixcasetrackingflag:0,
      recheckofferflag:0,
      fixpaymentdetailflag:0,
      varvalue5day:'',varvalue5month:'',varvalue5year:'',varvalue6day:'',varvalue6month:'',varvalue6year:'',
      varvalue7day:'',varvalue7month:'',varvalue7year:'',varvalue8day:'',varvalue8month:'',varvalue8year:'',
      varvalue9day:'',varvalue9month:'',varvalue9year:'',varvalue10day:'',varvalue10month:'',varvalue10year:'',
      varvalue11day:'',varvalue11month:'',varvalue11year:'',varvalue12day:'',varvalue12month:'',varvalue12year:'',
      varvalue13day:'',varvalue13month:'',varvalue13year:'',varvalue14day:'',varvalue14month:'',varvalue14year:'',
      varvalue15day:'',varvalue15month:'',varvalue15year:'',varvalue16day:'',varvalue16month:'',varvalue16year:'',
      varvalue17day:'',varvalue17month:'',varvalue17year:'',varvalue18day:'',varvalue18month:'',varvalue18year:'',
      varvalue19day:'',varvalue19month:'',varvalue19year:'',varvalue20day:'',varvalue20month:'',varvalue20year:'',
      varvalue21day:'',varvalue21month:'',varvalue21year:'',varvalue22day:'',varvalue22month:'',varvalue22year:'',
      varvalue23day:'',varvalue23month:'',varvalue23year:'',varvalue24day:'',varvalue24month:'',varvalue24year:'',
      varvalue25day:'',varvalue25month:'',varvalue25year:'',varvalue51day:'',varvalue51month:'',varvalue51year:'',
      varvalue52day:'',varvalue52month:'',varvalue52year:'',varvalue53day:'',varvalue53month:'',varvalue53year:'',
      showall:'box collapsed-box',
      taxcopypayment:[],
      actcopypayment:[],
      insurancecopypayment:[],
      anotherfile:[],
      caseid2:'',
      note_from_previous_case:'',
      note_to_copy_to_renew_case:'',
      note_from_member:'',
      note_from_user:'',
      note_from_partner:'',
      filvar_value38:'',
      filvar_value39:'',
      filvar_value40:'',
      filvar_value41:'',
      filvar_value42:'',
      filvar_value43:'',
      filvar_value44:'',
      filvar_value45:'',
      filvar_value46:'',
      casescheck:[],
      data:'',
      blink:'',

    };
    this.columnchangecasetracking = this.columnchangecasetracking.bind(this);
    this.columnchangecasetrackingdefault = this.columnchangecasetrackingdefault.bind(this);
    this.columnchangecasedetail = this.columnchangecasedetail.bind(this);
    this.columnchangecasedetaildefault = this.columnchangecasedetaildefault.bind(this);
    this.columnchangecaseasset = this.columnchangecaseasset.bind(this);
    this.columnchangecaseassetdefault = this.columnchangecaseassetdefault.bind(this);
    this.columnchangecasepayment = this.columnchangecasepayment.bind(this);
    this.columnchangecasepaymentdefault = this.columnchangecasepaymentdefault.bind(this);
    this.loadmemberfile = this.loadmemberfile.bind(this);
    this.reloadmemberfile = this.reloadmemberfile.bind(this);
    this.reloadcarfile = this.reloadcarfile.bind(this);
    this.autoload = this.autoload.bind(this);
    this.updatestage = this.updatestage.bind(this);
    this.opennoteprevcase = this.opennoteprevcase.bind(this);
    this.closenoteprevcase = this.closenoteprevcase.bind(this);
    this.handleSubmitnoteprevcase = this.handleSubmitnoteprevcase.bind(this);
    this.opennotenextcase = this.opennotenextcase.bind(this);
    this.closenotenextcase = this.closenotenextcase.bind(this);
    this.handleSubmitnotenextcase = this.handleSubmitnotenextcase.bind(this);
    this.opennotefrommember = this.opennotefrommember.bind(this);
    this.closenotefrommember = this.closenotefrommember.bind(this);
    this.handleSubmitnotefrommember = this.handleSubmitnotefrommember.bind(this);
    this.handleSubmitnotefrompartner = this.handleSubmitnotefrompartner.bind(this);
    this.opennotefrompartner = this.opennotefrompartner.bind(this);
    this.closenotefrompartner = this.closenotefrompartner.bind(this);
    this.handleSubmitnotefromuser = this.handleSubmitnotefromuser.bind(this);
    this.opennotefromuser = this.opennotefromuser.bind(this);
    this.closenotefromuser = this.closenotefromuser.bind(this);
    this.handleChangenoteprevcase = this.handleChangenoteprevcase.bind(this);
    this.handleChangenotenextcase = this.handleChangenotenextcase.bind(this);
    this.handleChangenotefrommember = this.handleChangenotefrommember.bind(this);
    this.handleChangenotefrompartner = this.handleChangenotefrompartner.bind(this);
    this.handleChangenotefromuser = this.handleChangenotefromuser.bind(this);
    this.openfixcasetracking = this.openfixcasetracking.bind(this);
    this.closefixcasetracking = this.closefixcasetracking.bind(this);
    this.openfixact38= this.openfixact38.bind(this);
    this.closefixact38= this.closefixact38.bind(this);
    this.openfixact39= this.openfixact39.bind(this);
    this.closefixact39= this.closefixact39.bind(this);
    this.openfixact40= this.openfixact40.bind(this);
    this.closefixact40= this.closefixact40.bind(this);
    this.openfixins41= this.openfixins41.bind(this);
    this.closefixins41= this.closefixins41.bind(this);
    this.openfixins42= this.openfixins42.bind(this);
    this.closefixins42= this.closefixins42.bind(this);
    this.openfixins43= this.openfixins43.bind(this);
    this.closefixins43= this.closefixins43.bind(this);
    this.openfixtax44= this.openfixtax44.bind(this);
    this.closefixtax44= this.closefixtax44.bind(this);
    this.openfixtax45= this.openfixtax45.bind(this);
    this.closefixtax45= this.closefixtax45.bind(this);
    this.openfixtax46= this.openfixtax46.bind(this);
    this.handleSubmitfixtax46= this.handleSubmitfixtax46.bind(this);
    this.handleChangefixtax46= this.handleChangefixtax46.bind(this);
    this.handleSubmitfixtax45= this.handleSubmitfixtax45.bind(this);
    this.handleChangefixtax45= this.handleChangefixtax45.bind(this);
    this.handleSubmitfixtax44= this.handleSubmitfixtax44.bind(this);
    this.handleChangefixtax44= this.handleChangefixtax44.bind(this);
    this.handleSubmitfixins43= this.handleSubmitfixins43.bind(this);
    this.handleChangefixins43= this.handleChangefixins43.bind(this);
    this.handleSubmitfixins42= this.handleSubmitfixins42.bind(this);
    this.handleChangefixins42= this.handleChangefixins42.bind(this);
    this.handleSubmitfixins41= this.handleSubmitfixins41.bind(this);
    this.handleChangefixins41= this.handleChangefixins41.bind(this);
    this.handleSubmitfixact40= this.handleSubmitfixact40.bind(this);
    this.handleChangefixact40= this.handleChangefixact40.bind(this);
    this.handleSubmitfixact39= this.handleSubmitfixact39.bind(this);
    this.handleChangefixact39= this.handleChangefixact39.bind(this);
    this.handleSubmitfixact38= this.handleSubmitfixact38.bind(this);
    this.handleChangefixact38= this.handleChangefixact38.bind(this);
    this.submitcasetracking= this.submitcasetracking.bind(this);
    this.openfixpaymentdetail= this.openfixpaymentdetail.bind(this);
    this.closefixpaymentdetail= this.closefixpaymentdetail.bind(this);
    this.submitcasepayment= this.submitcasepayment.bind(this);
    this.showall= this.showall.bind(this);
    this.closeall= this.closeall.bind(this);
    this.renewcase= this.renewcase.bind(this);

  }

  componentDidMount(){
    let data = Array.from(this.props.cases);
    console.log("Casesfind"+data)

    console.log("Cases"+this.props.cases)
    /*this.casescheck = data.map((item, key) =>
    console.log(item.name)
  );*/
    console.log("Yup"+this.props.id)
    console.log("YupName"+this.props.name)
    axios.get('/wealththaiinsurance/load/day').then(response=>{
      this.setState({day:response.data});
    })
    axios.get('/wealththaiinsurance/load/month').then(response=>{
      this.setState({month:response.data});
    })
    axios.get('/wealththaiinsurance/load/year').then(response=>{
      this.setState({year:response.data});
    })
    console.log(window.location.href);
    const url = window.location.href;

    let splitcaseid = url.split('/wealththaiinsurance/cases/');
        splitcaseid  =splitcaseid[1].split('/detail')
    console.log("Leetsee"+splitcaseid[0])
    axios.get('/wealththaiinsurance/casesdetail/'+splitcaseid[0]+'/detail/show').then(res=>{
      this.setState({filcase:res.data,blink:url});
      console.log("res"+res.data);
      res.data.map( data=>this.state.data = data)
      res.data.map( data=>this.setState({caseid2:data.id}))
      res.data.map( data=>this.state.note_from_previous_case = data.note_from_previous_case)
      res.data.map( data=>this.state.note_to_copy_to_renew_case = data.note_to_copy_to_renew_case)
      res.data.map( data=>this.state.note_from_member = data.note_from_member)
      res.data.map( data=>this.state.note_from_user = data.note_from_user)
      res.data.map( data=>this.state.note_from_partner = data.note_from_partner)
      res.data.map( data=>this.state.filvar_value38 = data.var_value38)
      res.data.map( data=>this.state.filvar_value39 = data.var_value39)
      res.data.map( data=>this.state.filvar_value40 = data.var_value40)
      res.data.map( data=>this.state.filvar_value41 = data.var_value41)
      res.data.map( data=>this.state.filvar_value42 = data.var_value42)
      res.data.map( data=>this.state.filvar_value43 = data.var_value43)
      res.data.map( data=>this.state.filvar_value44 = data.var_value44)
      res.data.map( data=>this.state.filvar_value45 = data.var_value45)
      res.data.map( data=>this.state.filvar_value46 = data.var_value46)
      console.log("Case"+this.state.caseid2);
      this.allfile();
      this.autoload();
      this.updatestage();
      this.reloadmemberfile();
      this.loadmemberfile();
    //  setInterval(this.reloadmemberfile, 1000);
    //   setInterval(this.loadmemberfile, 1000);
    //  setInterval(this.updatestage, 1000);
    }
  ).catch(errors=>{
      console.log(errors);
    })
  /////////////////////

  console.log("NEWVERSION1.3")
  //setInterval(this.allfile, 1000);

  }
  renewcase()
{
  axios.get('/wealththaiinsurance/renew/case?fromcase'+this.state.data.id).then(response=>{
    this.setState({filcase:response.data});
      console.log('renewcase');
  }).catch(errors=>{
    console.log(errors);
  })
  console.log("renew");
}
  showall()
  {
    this.setState({
      showall:"box",
      casetrackingcolumn:1,
      casedetailcolumn:1,
      casepaymentcolumn:1,
      caseassetcolumn:1,
    })
    console.log("hi")
  }
  closeall()
  {
    this.setState({
      showall:"box collapsed-box",
      casetrackingcolumn:0,
      casedetailcolumn:0,
      casepaymentcolumn:0,
      caseassetcolumn:0,
    })
  }
  allfile()
  {
    axios.post('/wealththaiinsurance/add/memberfile',{
      memberid:this.state.data.member_case_owner,
    }).then(res=>{
      console.log("Heymemberfile"+res.data);
      this.setState({
        memberfile:res.data,
        reloadmemfileflag:0
      })
    });
    axios.post('/wealththaiinsurance/casefile/load',{
      caseid:this.state.data.id,
    }).then(res=>{
      console.log('Casefilenaja',res.data);
      this.setState({
        casefile:res.data,
        reloadmemfileflag:0
      })
    });
    axios.post('/wealththaiinsurance/assetfile/load',{
      assetid:this.state.data.referal_asset,
    }).then(res=>{

      console.log(res.data);
      this.setState({
        assetfile:res.data,
        reloadmemfileflag:0

      })

    });
  }
  updatestage()
  {
    console.log("UPDATEORNOT"+this.state.caseid2);

    axios.get('/wealththaiinsurance/cases/update/stage?fromcase'+this.state.caseid2,{
    }).then(res=>{
    //  console.log("UPDATEORNOT"+res.data+caseid);
      this.setState({
        filcase:res.data,

      })
      res.data.map( data=>this.state.data = data)

    });
  }
  autoload()
  {
    console.log("Autoload"+this.state.caseid2)
    axios.get('/wealththaiinsurance/load/confirmoffer?filteroffer'+this.state.caseid2).then(response=>{
        this.setState({arrayconfirmoffer:response.data});
      }).catch(errors=>{
        console.log(errors);
      })
    axios.get('/wealththaiinsurance/load/proposal?filterproposal'+this.state.caseid2).then(response=>{
        this.setState({proposal:response.data});
          console.log('proposal');
      }).catch(errors=>{
        console.log(errors);
      })
    axios.get('/wealththaiinsurance/alloffer/load?filteroffer'+this.state.caseid2).then(response=>{
      this.setState({alloffer:response.data});
        console.log('alloffer');
    }).catch(errors=>{
      console.log(errors);
    })

      axios.get('/wealththaiinsurance/alloffer/load?filteroffer'+this.state.caseid2).then(response=>{
        this.setState({offer:response.data});
          console.log('offerrrrrr');
      }).catch(errors=>{
        console.log(errors);
      })
      axios.get('/wealththaiinsurance/interestoffer/load?filteroffer'+this.state.caseid2).then(response=>{
        this.setState({intertestoffer:response.data});
          //console.log('offer');
      }).catch(errors=>{
        console.log(errors);
      })
      axios.get('/wealththaiinsurance/lastestoffer/load?filteroffer'+this.state.caseid2).then(response=>{
        this.setState({lastestoffer:response.data});
          console.log(data.id);
      }).catch(errors=>{
        console.log(errors);
      })
      axios.get('/wealththaiinsurance/confirmoffer/load?filteroffer'+this.state.caseid2).then(response=>{
        this.setState({confirmoffer:response.data});
          console.log(this.state.confirmoffer);
      }).catch(errors=>{
        console.log(errors);
      })
  }
  reloadcarfile()
  {

    this.setState({
      refreshcarfile:'fa fa-refresh fa-spin'
    })
    axios.post('/wealththaiinsurance/assetfile/load',{
      assetid:this.state.data.referal_asset,
    }).then(res=>{

      console.log(res.data);
      this.setState({
        assetfile:res.data,
        refreshcarfile:'fa fa-refresh',
      })
    });
  }
  reloadmemberfile()
  {

    this.setState({
      refresh:'fa fa-refresh fa-spin'
    })
    axios.post('/wealththaiinsurance/add/memberfile',{
      memberid:this.state.data.member_case_owner,
    }).then(res=>{

      //console.log(res.data);
      this.setState({
        memberfile:res.data,
        refresh:'fa fa-refresh'
      })

    });



  }
  openfixcasetracking()
  {
    this.state.varvalue1 = this.state.data.var_value1;
    if(this.state.data.var_value5 == null){this.state.data.var_value5  = "///"}if(this.state.data.var_value6 == null){this.state.data.var_value6 = "///"}if(this.state.data.var_value7 == null){this.state.data.var_value7 = "///"}if(this.state.data.var_value8 == null){this.state.data.var_value8 = "///"}
    if(this.state.data.var_value9 == null){this.state.data.var_value9 = "///"}if(this.state.data.var_value10 == null){this.state.data.var_value10 = "///"}if(this.state.data.var_value11 == null){this.state.data.var_value11 = "///"}if(this.state.data.var_value12 == null){this.state.data.var_value12 = "///"}
    if(this.state.data.var_value13 == null){this.state.data.var_value13 = "///"}if(this.state.data.var_value14 == null){this.state.data.var_value14 = "///"}if(this.state.data.var_value15 == null){this.state.data.var_value15 = "///"}if(this.state.data.var_value16 == null){this.state.data.var_value16 = "///"}
    if(this.state.data.var_value17 == null){this.state.data.var_value17 = "///"}if(this.state.data.var_value18 == null){this.state.data.var_value18 = "///"}if(this.state.data.var_value19 == null){this.state.data.var_value19 = "///"}if(this.state.data.var_value20 == null){this.state.data.var_value20  = "///"}
    if(this.state.data.var_value21 == null){this.state.data.var_value21 = "///"}if(this.state.data.var_value22 == null){this.state.data.var_value22  = "///"}if(this.state.data.var_value23 == null){this.state.data.var_value23 = "///"}if(this.state.data.var_value24 == null){this.state.data.var_value24 = "///"}
    if(this.state.data.var_value25 == null){this.state.data.var_value25 = "///"}if(this.state.data.var_value51 == null){this.state.data.var_value51 = "///"}if(this.state.data.var_value52 == null){this.state.data.var_value52 = "///"}if(this.state.data.var_value53 == null){this.state.data.var_value53 = "///"}
    const var5 = this.state.data.var_value5.split('/');this.state.varvalue5day = var5[0];this.state.varvalue5month = var5[1];this.state.varvalue5year = var5[2];
    const var6 = this.state.data.var_value6.split('/');this.state.varvalue6day = var6[0];this.state.varvalue6month = var6[1];this.state.varvalue6year = var6[2];
    const var7 = this.state.data.var_value7.split('/');this.state.varvalue7day = var7[0];this.state.varvalue7month = var7[1];this.state.varvalue7year = var7[2];
    const var8 = this.state.data.var_value8.split('/');this.state.varvalue8day = var8[0];this.state.varvalue8month = var8[1];this.state.varvalue8year = var8[2];
    const var9 = this.state.data.var_value9.split('/');this.state.varvalue9day = var9[0];this.state.varvalue9month = var9[1];this.state.varvalue9year = var9[2];
    const var10 = this.state.data.var_value10.split('/');this.state.varvalue10day = var10[0];this.state.varvalue10month = var10[1];this.state.varvalue10year = var10[2];
    const var11 = this.state.data.var_value11.split('/');this.state.varvalue11day = var11[0];this.state.varvalue11month = var11[1];this.state.varvalue11year = var11[2];
    const var12 = this.state.data.var_value12.split('/');this.state.varvalue12day = var12[0];this.state.varvalue12month = var12[1];this.state.varvalue12year = var12[2];
    const var13 = this.state.data.var_value13.split('/');this.state.varvalue13day = var13[0];this.state.varvalue13month = var13[1];this.state.varvalue13year = var13[2];
    const var14 = this.state.data.var_value14.split('/');this.state.varvalue14day = var14[0];this.state.varvalue14month = var14[1];this.state.varvalue14year = var14[2];
    const var15 = this.state.data.var_value15.split('/');this.state.varvalue15day = var15[0];this.state.varvalue15month = var15[1];this.state.varvalue15year = var15[2];
    const var16 = this.state.data.var_value16.split('/');this.state.varvalue16day = var16[0];this.state.varvalue16month = var16[1];this.state.varvalue16year = var16[2];
    const var17 = this.state.data.var_value17.split('/');this.state.varvalue17day = var17[0];this.state.varvalue17month = var17[1];this.state.varvalue17year = var17[2];
    const var18 = this.state.data.var_value18.split('/');this.state.varvalue18day = var18[0];this.state.varvalue18month = var18[1];this.state.varvalue18year = var18[2];
    const var19 = this.state.data.var_value19.split('/');this.state.varvalue19day = var19[0];this.state.varvalue19month = var19[1];this.state.varvalue19year = var19[2];
    const var20 = this.state.data.var_value20.split('/');this.state.varvalue20day = var20[0];this.state.varvalue20month = var20[1];this.state.varvalue20year = var20[2];
    const var21 = this.state.data.var_value21.split('/');this.state.varvalue21day = var21[0];this.state.varvalue21month = var21[1];this.state.varvalue21year = var21[2];
    const var22 = this.state.data.var_value22.split('/');this.state.varvalue22day = var22[0];this.state.varvalue22month = var22[1];this.state.varvalue22year = var22[2];
    const var23 = this.state.data.var_value23.split('/');this.state.varvalue23day = var23[0];this.state.varvalue23month = var23[1];this.state.varvalue23year = var23[2];
    const var24 = this.state.data.var_value24.split('/');this.state.varvalue24day = var24[0];this.state.varvalue24month = var24[1];this.state.varvalue24year = var24[2];
    const var25 = this.state.data.var_value25.split('/');this.state.varvalue25day = var25[0];this.state.varvalue25month = var25[1];this.state.varvalue25year = var25[2];
    const var51 = this.state.data.var_value51.split('/');this.state.varvalue51day = var51[0];this.state.varvalue51month = var51[1];this.state.varvalue51year = var51[2];
    const var52 = this.state.data.var_value52.split('/');this.state.varvalue52day = var52[0];this.state.varvalue52month = var52[1];this.state.varvalue52year = var52[2];
    const var53 = this.state.data.var_value53.split('/');this.state.varvalue53day = var53[0];this.state.varvalue53month = var53[1];this.state.varvalue53year = var53[2];

    this.setState({
        fixcasetrackingflag : 1,

    });
  }
  closefixcasetracking()
  {
    this.setState({
        fixcasetrackingflag : 0
    });
  }


  showassetdetail(data){
    if(data.referal_asset != null && data.referal_asset != 0){
      return <div><div class="column5"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>


       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >หมายเลขสินทรัพย์</th>
                   <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.id}</th>
                 </tr>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >ทะเบียนรถ</th>
                   <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.ref_name}</th>
                 </tr>

                 </thead>
                 </table>
                 </div>
                 <div class="column5"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                 <thead>
                             <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                            <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >ยี่ห้อ</th>
                              <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.ref_info3}</th>
                            </tr>
                             <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                            <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >รุ่น</th>
                              <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.ref_info4}</th>
                            </tr>

                            </thead>
                            </table>
                            </div>
                            <div class="column5"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <thead>
                                        <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                                       <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >รุ่นปี (ค.ศ.)</th>
                                         <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.ref_info5}</th>
                                       </tr>
                                        <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                                       <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >ขนาดเครื่อง (cc)</th>
                                         <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.ref_info8}</th>
                                       </tr>

                                       </thead>
                                       </table>
                                       </div>
                                       <div class="column5"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                       <thead>
                                                   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                                                  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >จังหวัดจดทะเบียน</th>
                                                    <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.ref_info1}</th>
                                                  </tr>
                                                   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                                                  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >รหัส และ รูปแบบการใช้งาน</th>
                                                    <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.ref_info7}</th>
                                                  </tr>

                                                  </thead>
                                                  </table>
                                                  </div>
                                                  <div class="column5"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                                  <thead>

                                                              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                                                             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >รายละเอียดเครื่องประดับยนต์</th>
                                                               <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.ref_info9}</th>
                                                             </tr>
                                                              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                                                             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >มูลค่าเครื่องประดับยนต์</th>
                                                               <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.ref_info10}</th>
                                                             </tr>
                                                             </thead>
                                                             </table>
                                                             </div>
                </div>
    }
    else{
      return '';
    }
  }
  submitcasetracking(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/casetracking',{
      id:this.state.caseid2,
      var1:this.state.varvalue1,
      var5:this.state.varvalue5day+'/'+this.state.varvalue5month+'/'+this.state.varvalue5year,
      var6:this.state.varvalue6day+'/'+this.state.varvalue6month+'/'+this.state.varvalue6year,
      var7:this.state.varvalue7day+'/'+this.state.varvalue7month+'/'+this.state.varvalue7year,
      var8:this.state.varvalue8day+'/'+this.state.varvalue8month+'/'+this.state.varvalue8year,
      var9:this.state.varvalue9day+'/'+this.state.varvalue9month+'/'+this.state.varvalue9year,
      var10:this.state.varvalue10day+'/'+this.state.varvalue10month+'/'+this.state.varvalue10year,
      var11:this.state.varvalue11day+'/'+this.state.varvalue11month+'/'+this.state.varvalue11year,
      var12:this.state.varvalue12day+'/'+this.state.varvalue12month+'/'+this.state.varvalue12year,
      var13:this.state.varvalue13day+'/'+this.state.varvalue13month+'/'+this.state.varvalue13year,
      var14:this.state.varvalue14day+'/'+this.state.varvalue14month+'/'+this.state.varvalue14year,
      var15:this.state.varvalue15day+'/'+this.state.varvalue15month+'/'+this.state.varvalue15year,
      var16:this.state.varvalue16day+'/'+this.state.varvalue16month+'/'+this.state.varvalue16year,
      var17:this.state.varvalue17day+'/'+this.state.varvalue17month+'/'+this.state.varvalue17year,
      var18:this.state.varvalue18day+'/'+this.state.varvalue18month+'/'+this.state.varvalue18year,
      var19:this.state.varvalue19day+'/'+this.state.varvalue19month+'/'+this.state.varvalue19year,
      var20:this.state.varvalue20day+'/'+this.state.varvalue20month+'/'+this.state.varvalue20year,
      var21:this.state.varvalue21day+'/'+this.state.varvalue21month+'/'+this.state.varvalue21year,
      var22:this.state.varvalue22day+'/'+this.state.varvalue22month+'/'+this.state.varvalue22year,
      var23:this.state.varvalue23day+'/'+this.state.varvalue23month+'/'+this.state.varvalue23year,
      var24:this.state.varvalue24day+'/'+this.state.varvalue24month+'/'+this.state.varvalue24year,
      var25:this.state.varvalue25day+'/'+this.state.varvalue25month+'/'+this.state.varvalue25year,
      var51:this.state.varvalue51day+'/'+this.state.varvalue51month+'/'+this.state.varvalue51year,
      var52:this.state.varvalue52day+'/'+this.state.varvalue52month+'/'+this.state.varvalue52year,
      var53:this.state.varvalue53day+'/'+this.state.varvalue53month+'/'+this.state.varvalue53year,

    }).then(res=>{

      console.log(res.data);
      this.setState({
        filcase:res.data,
        fixcasetrackingflag:0,

      })
    });
  }
  handlechangevarvalue1(e){
    console.log(e.target.value);
    this.setState({
      varvalue1:e.target.value,
    })
  }
  fixcasetracking(data)
  {

    if(this.state.fixcasetrackingflag == 0)
    {
      return <div class="column" id="casetracking">
      <div class="box" style={{backgroundColor:'#F5F5F5'}}>
      <div class="box-header" >
        <b class="box-title" >สถานะงาน (Case Tracking)</b>
        <div class="box-tools pull-left">
        <button type="button" onClick={this.openfixcasetracking}class="btn btn-box-tool" ><i style={{color:'orange'}} class="fa fa-gear"></i></button>
          <button type="button" onClick={this.columnchangecasetrackingdefault}class="btn btn-box-tool" ><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" >
      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
     <tr role="row" >
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>สถานะงาน</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{data.case_status.name}</th>
    </tr>
      <tr role="row" >
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ขั้นตอนงาน</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.stagename(data)}</th>
     </tr>
     <tr role="row" >
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่งานเสร็จสิ้น</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{data.finish_date}</th>
    </tr>
     <tr role="row" >
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name1}</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value1}</th>
    </tr>
      {this.showcasestatus(data)}

      <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ว้นที่แก้ไขล่าสุด</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.last_updated_date}</th>
      </tr>

       <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ต้องติดตามงาน</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.match_id.public_name}</th>
      </tr>

       <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ต่ออายุอัตโนมัติ</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.auto_renew_date}</th>
      </tr>
      <tr role="row" >
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ กรมธรรม(เดิม) หมดอายุ</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value8}</th>
     </tr>
     <tr role="row" >
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ พรบ(เดิม) หมดอายุ </th>
      <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value7}</th>
    </tr>
      </thead>
      </table>

      </div>
      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>


       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ ภาษี(เดิม) หมดอายุ </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value9}</th>
      </tr>
      <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name52}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value52}</th>
      </tr>
      <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name51}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value51}</th>
      </tr>
      <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name53}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value53}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name2} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value2}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name3} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value3}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name4} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value4}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name5} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value5}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name6} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value6}</th>
      </tr>

      </thead>
      </table>

      </div>
      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name7} </th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value7}</th>
     </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name8} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value8}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name9} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value9}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name10} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value10}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name11} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value11}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name12} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value12}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name13} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value13}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name14} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value14}</th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>&nbsp;</th>
       <th style={{backgroundColor:'#F4F4F6'}}>&nbsp;</th>
     </tr>
      </thead>
      </table>
      </div>
      <div class="column">


      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name15} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value15}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name16} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value16}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name17} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value17}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name18} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value18}</th>
      </tr>



    </thead>
      </table>

      </div>
      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name19} </th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value19}</th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name20} </th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value20}</th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name21} </th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value21}</th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name22} </th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value22}</th>
     </tr>

    </thead>
      </table>
      </div>
      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name23} </th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value23}</th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name24} </th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value24}</th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name25} </th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value25}</th>
     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>&nbsp;</th>
      <th style={{backgroundColor:'#F4F4F6'}}>&nbsp;</th>
    </tr>
    </thead>
      </table>
      </div>
      </div>


      </div>
      </div>
      </div>
    }
    else
    {
      return <form onSubmit={this.submitcasetracking}><div class="column" id="casetracking">
      <div class="box" style={{backgroundColor:'#F5F5F5'}}>
      <div class="box-header" >
        <b class="box-title" >สถานะงาน (Case Tracking)</b>
        <div class="box-tools pull-left">
        <button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button>
        <button type="button" onClick={this.closefixcasetracking}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button>
          <button type="button" onClick={this.columnchangecasetrackingdefault}class="btn btn-box-tool" ><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" >

      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
     <tr role="row" >
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>สถานะงาน</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{data.case_status.name}</th>
    </tr>
      <tr role="row" >
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ขั้นตอนงาน</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.stagename(data)}</th>
     </tr>
     <tr role="row" >
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่งานเสร็จสิ้น</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{data.finish_date}</th>
    </tr>
     <tr role="row" >
    <th  style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name1}</th>
      <th style={{backgroundColor:'white'}}>&nbsp;<input class="form-control" onChange={this.handlechangevarvalue1}value={this.state.varvalue1}/></th>
    </tr>
      {this.showcasestatus(data)}

      <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ว้นที่แก้ไขล่าสุด</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.last_updated_date}</th>
      </tr>

       <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ต้องติดตามงาน</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.match_id.public_name}</th>
      </tr>

       <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ต่ออายุอัตโนมัติ</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.auto_renew_date}</th>
      </tr>
       <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ กรมธรรม(เดิม)หมดอายุ</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value8}</th>
      </tr>
      <tr role="row" >
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ พรบ(เดิม) หมดอายุ </th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value7}</th>
     </tr>
      </thead>
      </table>

      </div>
      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>

       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ ภาษี(เดิม) หมดอายุ </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value9}</th>
      </tr>
      <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name52}</th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue52day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue52day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue52day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue52day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue52day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue52day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue52day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue52day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue52day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue52day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue52day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue52month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue52month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue52month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue52month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue52month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue52month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue52month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue52month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue52month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue52month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue52month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue52year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue52year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select>
        </th>
      </tr>
      <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name51}</th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue51day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue51day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue51day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue51day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue51day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue51day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue51day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue51day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue51day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue51day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue51day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue51month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue51month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue51month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue51month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue51month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue51month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue51month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue51month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue51month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue51month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue51month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue51year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue51year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select>
        </th>
      </tr>
      <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name53}</th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue53day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue53day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue53day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue53day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue53day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue53day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue53day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue53day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue53day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue53day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue53day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue53month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue53month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue53month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue53month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue53month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue53month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue53month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue53month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue53month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue53month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue53month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue53year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue53year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select>
        </th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name2} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value2}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name3} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value3}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name4} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.var_value4}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name5} </th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue5day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue5day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue5day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue5day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue5day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue5day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue5day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue5day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue5day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue5day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue5day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue5month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue5month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue5month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue5month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue5month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue5month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue5month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue5month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue5month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue5month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue5month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue5year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue5year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select></th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name6} </th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue6day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue6day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue6day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue6day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue6day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue6day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue6day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue6day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue6day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue6day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue6day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue6month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue6month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue6month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue6month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue6month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue6month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue6month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue6month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue6month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue6month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue6month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue6year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue6year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select></th>
      </tr>

      </thead>
      </table>

      </div>
      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name7} </th>
       <th style={{backgroundColor:'white'}}>
       <select onChange={(e) => this.setState({ varvalue7day: e.target.value })} name="dayex">
       <option value ="">  วัน  </option>
       <option value ="01" selected={this.state.varvalue7day == '01' ? 'selected' : ''}>  01  </option>
       <option value ="02" selected={this.state.varvalue7day == '02' ? 'selected' : ''}>  02  </option>
       <option value ="03" selected={this.state.varvalue7day == '03' ? 'selected' : ''}>  03  </option>
       <option value ="04" selected={this.state.varvalue7day == '04' ? 'selected' : ''}>  04  </option>
       <option value ="05" selected={this.state.varvalue7day == '05' ? 'selected' : ''}>  05  </option>
       <option value ="06" selected={this.state.varvalue7day == '06' ? 'selected' : ''}>  06  </option>
       <option value ="07" selected={this.state.varvalue7day == '07' ? 'selected' : ''}>  07  </option>
       <option value ="08" selected={this.state.varvalue7day == '08' ? 'selected' : ''}>  08  </option>
       <option value ="09" selected={this.state.varvalue7day == '09' ? 'selected' : ''}>  09  </option>          {
         this.state.day.map(
           data =>
           <option value={data} selected={this.state.varvalue7day == data ? 'selected' : ''}>{data}</option>
         )
         }
         </select>

         <select  onChange={(e) => this.setState({ varvalue7month: e.target.value })}>
         <option value ="">  เดือน  </option>
         <option value ="01"  selected={this.state.varvalue7month == '01' ? 'selected' : ''}>  01  </option>
         <option value ="02"  selected={this.state.varvalue7month == '02' ? 'selected' : ''}>  02  </option>
         <option value ="03"  selected={this.state.varvalue7month == '03' ? 'selected' : ''}>  03  </option>
         <option value ="04"  selected={this.state.varvalue7month == '04' ? 'selected' : ''}>  04  </option>
         <option value ="05"  selected={this.state.varvalue7month == '05' ? 'selected' : ''}>  05  </option>
         <option value ="06"  selected={this.state.varvalue7month == '06' ? 'selected' : ''}>  06  </option>
         <option value ="07"  selected={this.state.varvalue7month == '07' ? 'selected' : ''}>  07  </option>
         <option value ="08"  selected={this.state.varvalue7month == '08' ? 'selected' : ''}>  08  </option>
         <option value ="09"  selected={this.state.varvalue7month == '09' ? 'selected' : ''}>  09  </option>
         {
           this.state.month.map(
             data =>
             <option value={data}  selected={this.state.varvalue7month == data ? 'selected' : ''}>{data}</option>
           )
           }
         </select>
       <select onChange={(e) => this.setState({ varvalue7year: e.target.value })}  >
       <option value ="">  ปี พ.ศ  </option>
       {
         this.state.year.map(
           data =>
           <option value={data}  selected={this.state.varvalue7year == data ? 'selected' : ''}>{data}</option>
         )
         }
       </select></th>
     </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name8} </th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue8day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue8day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue8day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue8day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue8day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue8day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue8day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue8day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue8day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue8day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue8day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue8month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue8month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue8month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue8month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue8month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue8month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue8month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue8month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue8month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue8month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue8month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue8year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue8year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select>
        </th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name9} </th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue9day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue9day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue9day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue9day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue9day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue9day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue9day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue9day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue9day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue9day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue9day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue9month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue9month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue9month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue9month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue9month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue9month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue9month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue9month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue9month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue9month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue9month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue9year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue9year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select>
        </th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name10} </th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue10day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue10day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue10day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue10day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue10day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue10day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue10day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue10day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue10day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue10day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue10day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue10month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue10month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue10month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue10month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue10month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue10month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue10month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue10month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue10month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue10month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue10month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue10year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue10year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select>
        </th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name11} </th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue11day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue11day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue11day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue11day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue11day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue11day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue11day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue11day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue11day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue11day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue11day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue11month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue11month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue11month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue11month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue11month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue11month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue11month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue11month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue11month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue11month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue11month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue11year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue11year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select>
        </th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name12} </th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue12day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue12day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue12day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue12day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue12day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue12day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue12day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue12day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue12day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue12day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue12day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue12month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue12month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue12month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue12month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue12month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue12month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue12month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue12month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue12month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue12month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue12month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue12year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue12year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select>
        </th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name13} </th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue13day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue13day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue13day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue13day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue13day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue13day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue13day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue13day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue13day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue13day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue13day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue13month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue13month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue13month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue13month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue13month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue13month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue13month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue13month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue13month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue13month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue13month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue13year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue13year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select>
        </th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name14} </th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue14day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue14day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue14day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue14day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue14day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue14day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue14day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue14day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue14day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue14day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue14day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue14day: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue14month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue14month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue14month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue14month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue14month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue14month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue14month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue14month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue14month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue14month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue14year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue14year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select>
        </th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>&nbsp;</th>
       <th style={{backgroundColor:'#F4F4F6'}}>&nbsp;</th>
     </tr>
      </thead>
      </table>
      </div>
      <div class="column">


      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name15} </th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue15day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue15day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue15day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue15day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue15day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue15day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue15day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue15day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue15day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue15day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue15day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue15month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue15month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue15month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue15month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue15month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue15month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue15month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue15month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue15month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue15month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue15month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue15year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue15year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select>
        </th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name16} </th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue16day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue16day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue16day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue16day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue16day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue16day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue16day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue16day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue16day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue16day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue16day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue16month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue16month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue16month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue16month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue16month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue16month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue16month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue16month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue16month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue16month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue16month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue16year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue16year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select>
        </th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name17} </th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue17day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue17day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue17day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue17day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue17day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue17day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue17day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue17day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue17day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue17day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue17day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue17month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue17month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue17month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue17month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue17month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue17month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue17month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue17month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue17month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue17month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue17month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue17year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue17year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select>
        </th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name18} </th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue18day: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" selected={this.state.varvalue18day == '01' ? 'selected' : ''}>  01  </option>
        <option value ="02" selected={this.state.varvalue18day == '02' ? 'selected' : ''}>  02  </option>
        <option value ="03" selected={this.state.varvalue18day == '03' ? 'selected' : ''}>  03  </option>
        <option value ="04" selected={this.state.varvalue18day == '04' ? 'selected' : ''}>  04  </option>
        <option value ="05" selected={this.state.varvalue18day == '05' ? 'selected' : ''}>  05  </option>
        <option value ="06" selected={this.state.varvalue18day == '06' ? 'selected' : ''}>  06  </option>
        <option value ="07" selected={this.state.varvalue18day == '07' ? 'selected' : ''}>  07  </option>
        <option value ="08" selected={this.state.varvalue18day == '08' ? 'selected' : ''}>  08  </option>
        <option value ="09" selected={this.state.varvalue18day == '09' ? 'selected' : ''}>  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} selected={this.state.varvalue18day == data ? 'selected' : ''}>{data}</option>
          )
          }
          </select>

          <select  onChange={(e) => this.setState({ varvalue18month: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  selected={this.state.varvalue18month == '01' ? 'selected' : ''}>  01  </option>
          <option value ="02"  selected={this.state.varvalue18month == '02' ? 'selected' : ''}>  02  </option>
          <option value ="03"  selected={this.state.varvalue18month == '03' ? 'selected' : ''}>  03  </option>
          <option value ="04"  selected={this.state.varvalue18month == '04' ? 'selected' : ''}>  04  </option>
          <option value ="05"  selected={this.state.varvalue18month == '05' ? 'selected' : ''}>  05  </option>
          <option value ="06"  selected={this.state.varvalue18month == '06' ? 'selected' : ''}>  06  </option>
          <option value ="07"  selected={this.state.varvalue18month == '07' ? 'selected' : ''}>  07  </option>
          <option value ="08"  selected={this.state.varvalue18month == '08' ? 'selected' : ''}>  08  </option>
          <option value ="09"  selected={this.state.varvalue18month == '09' ? 'selected' : ''}>  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  selected={this.state.varvalue18month == data ? 'selected' : ''}>{data}</option>
            )
            }
          </select>
        <select onChange={(e) => this.setState({ varvalue18year: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  selected={this.state.varvalue18year == data ? 'selected' : ''}>{data}</option>
          )
          }
        </select>
        </th>
      </tr>



    </thead>
      </table>

      </div>
      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name19} </th>
       <th style={{backgroundColor:'white'}}>
       <select onChange={(e) => this.setState({ varvalue19day: e.target.value })} name="dayex">
       <option value ="">  วัน  </option>
       <option value ="01" selected={this.state.varvalue19day == '01' ? 'selected' : ''}>  01  </option>
       <option value ="02" selected={this.state.varvalue19day == '02' ? 'selected' : ''}>  02  </option>
       <option value ="03" selected={this.state.varvalue19day == '03' ? 'selected' : ''}>  03  </option>
       <option value ="04" selected={this.state.varvalue19day == '04' ? 'selected' : ''}>  04  </option>
       <option value ="05" selected={this.state.varvalue19day == '05' ? 'selected' : ''}>  05  </option>
       <option value ="06" selected={this.state.varvalue19day == '06' ? 'selected' : ''}>  06  </option>
       <option value ="07" selected={this.state.varvalue19day == '07' ? 'selected' : ''}>  07  </option>
       <option value ="08" selected={this.state.varvalue19day == '08' ? 'selected' : ''}>  08  </option>
       <option value ="09" selected={this.state.varvalue19day == '09' ? 'selected' : ''}>  09  </option>          {
         this.state.day.map(
           data =>
           <option value={data} selected={this.state.varvalue19day == data ? 'selected' : ''}>{data}</option>
         )
         }
         </select>

         <select  onChange={(e) => this.setState({ varvalue19month: e.target.value })}>
         <option value ="">  เดือน  </option>
         <option value ="01"  selected={this.state.varvalue19month == '01' ? 'selected' : ''}>  01  </option>
         <option value ="02"  selected={this.state.varvalue19month == '02' ? 'selected' : ''}>  02  </option>
         <option value ="03"  selected={this.state.varvalue19month == '03' ? 'selected' : ''}>  03  </option>
         <option value ="04"  selected={this.state.varvalue19month == '04' ? 'selected' : ''}>  04  </option>
         <option value ="05"  selected={this.state.varvalue19month == '05' ? 'selected' : ''}>  05  </option>
         <option value ="06"  selected={this.state.varvalue19month == '06' ? 'selected' : ''}>  06  </option>
         <option value ="07"  selected={this.state.varvalue19month == '07' ? 'selected' : ''}>  07  </option>
         <option value ="08"  selected={this.state.varvalue19month == '08' ? 'selected' : ''}>  08  </option>
         <option value ="09"  selected={this.state.varvalue19month == '09' ? 'selected' : ''}>  09  </option>
         {
           this.state.month.map(
             data =>
             <option value={data}  selected={this.state.varvalue19month == data ? 'selected' : ''}>{data}</option>
           )
           }
         </select>
       <select onChange={(e) => this.setState({ varvalue19year: e.target.value })}  >
       <option value ="">  ปี พ.ศ  </option>
       {
         this.state.year.map(
           data =>
           <option value={data}  selected={this.state.varvalue19year == data ? 'selected' : ''}>{data}</option>
         )
         }
       </select>
       </th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name20} </th>
       <th style={{backgroundColor:'white'}}>
       <select onChange={(e) => this.setState({ varvalue20day: e.target.value })} name="dayex">
       <option value ="">  วัน  </option>
       <option value ="01" selected={this.state.varvalue20day == '01' ? 'selected' : ''}>  01  </option>
       <option value ="02" selected={this.state.varvalue20day == '02' ? 'selected' : ''}>  02  </option>
       <option value ="03" selected={this.state.varvalue20day == '03' ? 'selected' : ''}>  03  </option>
       <option value ="04" selected={this.state.varvalue20day == '04' ? 'selected' : ''}>  04  </option>
       <option value ="05" selected={this.state.varvalue20day == '05' ? 'selected' : ''}>  05  </option>
       <option value ="06" selected={this.state.varvalue20day == '06' ? 'selected' : ''}>  06  </option>
       <option value ="07" selected={this.state.varvalue20day == '07' ? 'selected' : ''}>  07  </option>
       <option value ="08" selected={this.state.varvalue20day == '08' ? 'selected' : ''}>  08  </option>
       <option value ="09" selected={this.state.varvalue20day == '09' ? 'selected' : ''}>  09  </option>          {
         this.state.day.map(
           data =>
           <option value={data} selected={this.state.varvalue20day == data ? 'selected' : ''}>{data}</option>
         )
         }
         </select>

         <select  onChange={(e) => this.setState({ varvalue20month: e.target.value })}>
         <option value ="">  เดือน  </option>
         <option value ="01"  selected={this.state.varvalue20month == '01' ? 'selected' : ''}>  01  </option>
         <option value ="02"  selected={this.state.varvalue20month == '02' ? 'selected' : ''}>  02  </option>
         <option value ="03"  selected={this.state.varvalue20month == '03' ? 'selected' : ''}>  03  </option>
         <option value ="04"  selected={this.state.varvalue20month == '04' ? 'selected' : ''}>  04  </option>
         <option value ="05"  selected={this.state.varvalue20month == '05' ? 'selected' : ''}>  05  </option>
         <option value ="06"  selected={this.state.varvalue20month == '06' ? 'selected' : ''}>  06  </option>
         <option value ="07"  selected={this.state.varvalue20month == '07' ? 'selected' : ''}>  07  </option>
         <option value ="08"  selected={this.state.varvalue20month == '08' ? 'selected' : ''}>  08  </option>
         <option value ="09"  selected={this.state.varvalue20month == '09' ? 'selected' : ''}>  09  </option>
         {
           this.state.month.map(
             data =>
             <option value={data}  selected={this.state.varvalue20month == data ? 'selected' : ''}>{data}</option>
           )
           }
         </select>
       <select onChange={(e) => this.setState({ varvalue20year: e.target.value })}  >
       <option value ="">  ปี พ.ศ  </option>
       {
         this.state.year.map(
           data =>
           <option value={data}  selected={this.state.varvalue20year == data ? 'selected' : ''}>{data}</option>
         )
         }
       </select>
       </th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name21} </th>
       <th style={{backgroundColor:'white'}}>
       <select onChange={(e) => this.setState({ varvalue21day: e.target.value })} name="dayex">
       <option value ="">  วัน  </option>
       <option value ="01" selected={this.state.varvalue21day == '01' ? 'selected' : ''}>  01  </option>
       <option value ="02" selected={this.state.varvalue21day == '02' ? 'selected' : ''}>  02  </option>
       <option value ="03" selected={this.state.varvalue21day == '03' ? 'selected' : ''}>  03  </option>
       <option value ="04" selected={this.state.varvalue21day == '04' ? 'selected' : ''}>  04  </option>
       <option value ="05" selected={this.state.varvalue21day == '05' ? 'selected' : ''}>  05  </option>
       <option value ="06" selected={this.state.varvalue21day == '06' ? 'selected' : ''}>  06  </option>
       <option value ="07" selected={this.state.varvalue21day == '07' ? 'selected' : ''}>  07  </option>
       <option value ="08" selected={this.state.varvalue21day == '08' ? 'selected' : ''}>  08  </option>
       <option value ="09" selected={this.state.varvalue21day == '09' ? 'selected' : ''}>  09  </option>          {
         this.state.day.map(
           data =>
           <option value={data} selected={this.state.varvalue21day == data ? 'selected' : ''}>{data}</option>
         )
         }
         </select>

         <select  onChange={(e) => this.setState({ varvalue21month: e.target.value })}>
         <option value ="">  เดือน  </option>
         <option value ="01"  selected={this.state.varvalue21month == '01' ? 'selected' : ''}>  01  </option>
         <option value ="02"  selected={this.state.varvalue21month == '02' ? 'selected' : ''}>  02  </option>
         <option value ="03"  selected={this.state.varvalue21month == '03' ? 'selected' : ''}>  03  </option>
         <option value ="04"  selected={this.state.varvalue21month == '04' ? 'selected' : ''}>  04  </option>
         <option value ="05"  selected={this.state.varvalue21month == '05' ? 'selected' : ''}>  05  </option>
         <option value ="06"  selected={this.state.varvalue21month == '06' ? 'selected' : ''}>  06  </option>
         <option value ="07"  selected={this.state.varvalue21month == '07' ? 'selected' : ''}>  07  </option>
         <option value ="08"  selected={this.state.varvalue21month == '08' ? 'selected' : ''}>  08  </option>
         <option value ="09"  selected={this.state.varvalue21month == '09' ? 'selected' : ''}>  09  </option>
         {
           this.state.month.map(
             data =>
             <option value={data}  selected={this.state.varvalue21month == data ? 'selected' : ''}>{data}</option>
           )
           }
         </select>
       <select onChange={(e) => this.setState({ varvalue21year: e.target.value })}  >
       <option value ="">  ปี พ.ศ  </option>
       {
         this.state.year.map(
           data =>
           <option value={data}  selected={this.state.varvalue21year == data ? 'selected' : ''}>{data}</option>
         )
         }
       </select>
       </th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name22} </th>
       <th style={{backgroundColor:'white'}}>
       <select onChange={(e) => this.setState({ varvalue22day: e.target.value })} name="dayex">
       <option value ="">  วัน  </option>
       <option value ="01" selected={this.state.varvalue22day == '01' ? 'selected' : ''}>  01  </option>
       <option value ="02" selected={this.state.varvalue22day == '02' ? 'selected' : ''}>  02  </option>
       <option value ="03" selected={this.state.varvalue22day == '03' ? 'selected' : ''}>  03  </option>
       <option value ="04" selected={this.state.varvalue22day == '04' ? 'selected' : ''}>  04  </option>
       <option value ="05" selected={this.state.varvalue22day == '05' ? 'selected' : ''}>  05  </option>
       <option value ="06" selected={this.state.varvalue22day == '06' ? 'selected' : ''}>  06  </option>
       <option value ="07" selected={this.state.varvalue22day == '07' ? 'selected' : ''}>  07  </option>
       <option value ="08" selected={this.state.varvalue22day == '08' ? 'selected' : ''}>  08  </option>
       <option value ="09" selected={this.state.varvalue22day == '09' ? 'selected' : ''}>  09  </option>          {
         this.state.day.map(
           data =>
           <option value={data} selected={this.state.varvalue22day == data ? 'selected' : ''}>{data}</option>
         )
         }
         </select>

         <select  onChange={(e) => this.setState({ varvalue22month: e.target.value })}>
         <option value ="">  เดือน  </option>
         <option value ="01"  selected={this.state.varvalue22month == '01' ? 'selected' : ''}>  01  </option>
         <option value ="02"  selected={this.state.varvalue22month == '02' ? 'selected' : ''}>  02  </option>
         <option value ="03"  selected={this.state.varvalue22month == '03' ? 'selected' : ''}>  03  </option>
         <option value ="04"  selected={this.state.varvalue22month == '04' ? 'selected' : ''}>  04  </option>
         <option value ="05"  selected={this.state.varvalue22month == '05' ? 'selected' : ''}>  05  </option>
         <option value ="06"  selected={this.state.varvalue22month == '06' ? 'selected' : ''}>  06  </option>
         <option value ="07"  selected={this.state.varvalue22month == '07' ? 'selected' : ''}>  07  </option>
         <option value ="08"  selected={this.state.varvalue22month == '08' ? 'selected' : ''}>  08  </option>
         <option value ="09"  selected={this.state.varvalue22month == '09' ? 'selected' : ''}>  09  </option>
         {
           this.state.month.map(
             data =>
             <option value={data}  selected={this.state.varvalue22month == data ? 'selected' : ''}>{data}</option>
           )
           }
         </select>
       <select onChange={(e) => this.setState({ varvalue22year: e.target.value })}  >
       <option value ="">  ปี พ.ศ  </option>
       {
         this.state.year.map(
           data =>
           <option value={data}  selected={this.state.varvalue22year == data ? 'selected' : ''}>{data}</option>
         )
         }
       </select>
       </th>
     </tr>

    </thead>
      </table>
      </div>
      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name23} </th>
       <th style={{backgroundColor:'white'}}>
       <select onChange={(e) => this.setState({ varvalue23day: e.target.value })} name="dayex">
       <option value ="">  วัน  </option>
       <option value ="01" selected={this.state.varvalue23day == '01' ? 'selected' : ''}>  01  </option>
       <option value ="02" selected={this.state.varvalue23day == '02' ? 'selected' : ''}>  02  </option>
       <option value ="03" selected={this.state.varvalue23day == '03' ? 'selected' : ''}>  03  </option>
       <option value ="04" selected={this.state.varvalue23day == '04' ? 'selected' : ''}>  04  </option>
       <option value ="05" selected={this.state.varvalue23day == '05' ? 'selected' : ''}>  05  </option>
       <option value ="06" selected={this.state.varvalue23day == '06' ? 'selected' : ''}>  06  </option>
       <option value ="07" selected={this.state.varvalue23day == '07' ? 'selected' : ''}>  07  </option>
       <option value ="08" selected={this.state.varvalue23day == '08' ? 'selected' : ''}>  08  </option>
       <option value ="09" selected={this.state.varvalue23day == '09' ? 'selected' : ''}>  09  </option>          {
         this.state.day.map(
           data =>
           <option value={data} selected={this.state.varvalue23day == data ? 'selected' : ''}>{data}</option>
         )
         }
         </select>

         <select  onChange={(e) => this.setState({ varvalue23month: e.target.value })}>
         <option value ="">  เดือน  </option>
         <option value ="01"  selected={this.state.varvalue23month == '01' ? 'selected' : ''}>  01  </option>
         <option value ="02"  selected={this.state.varvalue23month == '02' ? 'selected' : ''}>  02  </option>
         <option value ="03"  selected={this.state.varvalue23month == '03' ? 'selected' : ''}>  03  </option>
         <option value ="04"  selected={this.state.varvalue23month == '04' ? 'selected' : ''}>  04  </option>
         <option value ="05"  selected={this.state.varvalue23month == '05' ? 'selected' : ''}>  05  </option>
         <option value ="06"  selected={this.state.varvalue23month == '06' ? 'selected' : ''}>  06  </option>
         <option value ="07"  selected={this.state.varvalue23month == '07' ? 'selected' : ''}>  07  </option>
         <option value ="08"  selected={this.state.varvalue23month == '08' ? 'selected' : ''}>  08  </option>
         <option value ="09"  selected={this.state.varvalue23month == '09' ? 'selected' : ''}>  09  </option>
         {
           this.state.month.map(
             data =>
             <option value={data}  selected={this.state.varvalue23month == data ? 'selected' : ''}>{data}</option>
           )
           }
         </select>
       <select onChange={(e) => this.setState({ varvalue23year: e.target.value })}  >
       <option value ="">  ปี พ.ศ  </option>
       {
         this.state.year.map(
           data =>
           <option value={data}  selected={this.state.varvalue23year == data ? 'selected' : ''}>{data}</option>
         )
         }
       </select>
       </th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name24} </th>
       <th style={{backgroundColor:'white'}}>
       <select onChange={(e) => this.setState({ varvalue24day: e.target.value })} name="dayex">
       <option value ="">  วัน  </option>
       <option value ="01" selected={this.state.varvalue24day == '01' ? 'selected' : ''}>  01  </option>
       <option value ="02" selected={this.state.varvalue24day == '02' ? 'selected' : ''}>  02  </option>
       <option value ="03" selected={this.state.varvalue24day == '03' ? 'selected' : ''}>  03  </option>
       <option value ="04" selected={this.state.varvalue24day == '04' ? 'selected' : ''}>  04  </option>
       <option value ="05" selected={this.state.varvalue24day == '05' ? 'selected' : ''}>  05  </option>
       <option value ="06" selected={this.state.varvalue24day == '06' ? 'selected' : ''}>  06  </option>
       <option value ="07" selected={this.state.varvalue24day == '07' ? 'selected' : ''}>  07  </option>
       <option value ="08" selected={this.state.varvalue24day == '08' ? 'selected' : ''}>  08  </option>
       <option value ="09" selected={this.state.varvalue24day == '09' ? 'selected' : ''}>  09  </option>          {
         this.state.day.map(
           data =>
           <option value={data} selected={this.state.varvalue24day == data ? 'selected' : ''}>{data}</option>
         )
         }
         </select>

         <select  onChange={(e) => this.setState({ varvalue24month: e.target.value })}>
         <option value ="">  เดือน  </option>
         <option value ="01"  selected={this.state.varvalue24month == '01' ? 'selected' : ''}>  01  </option>
         <option value ="02"  selected={this.state.varvalue24month == '02' ? 'selected' : ''}>  02  </option>
         <option value ="03"  selected={this.state.varvalue24month == '03' ? 'selected' : ''}>  03  </option>
         <option value ="04"  selected={this.state.varvalue24month == '04' ? 'selected' : ''}>  04  </option>
         <option value ="05"  selected={this.state.varvalue24month == '05' ? 'selected' : ''}>  05  </option>
         <option value ="06"  selected={this.state.varvalue24month == '06' ? 'selected' : ''}>  06  </option>
         <option value ="07"  selected={this.state.varvalue24month == '07' ? 'selected' : ''}>  07  </option>
         <option value ="08"  selected={this.state.varvalue24month == '08' ? 'selected' : ''}>  08  </option>
         <option value ="09"  selected={this.state.varvalue24month == '09' ? 'selected' : ''}>  09  </option>
         {
           this.state.month.map(
             data =>
             <option value={data}  selected={this.state.varvalue24month == data ? 'selected' : ''}>{data}</option>
           )
           }
         </select>
       <select onChange={(e) => this.setState({ varvalue24year: e.target.value })}  >
       <option value ="">  ปี พ.ศ  </option>
       {
         this.state.year.map(
           data =>
           <option value={data}  selected={this.state.varvalue24year == data ? 'selected' : ''}>{data}</option>
         )
         }
       </select>
       </th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name25} </th>
       <th style={{backgroundColor:'white'}}>
       <select onChange={(e) => this.setState({ varvalue25day: e.target.value })} name="dayex">
       <option value ="">  วัน  </option>
       <option value ="01" selected={this.state.varvalue25day == '01' ? 'selected' : ''}>  01  </option>
       <option value ="02" selected={this.state.varvalue25day == '02' ? 'selected' : ''}>  02  </option>
       <option value ="03" selected={this.state.varvalue25day == '03' ? 'selected' : ''}>  03  </option>
       <option value ="04" selected={this.state.varvalue25day == '04' ? 'selected' : ''}>  04  </option>
       <option value ="05" selected={this.state.varvalue25day == '05' ? 'selected' : ''}>  05  </option>
       <option value ="06" selected={this.state.varvalue25day == '06' ? 'selected' : ''}>  06  </option>
       <option value ="07" selected={this.state.varvalue25day == '07' ? 'selected' : ''}>  07  </option>
       <option value ="08" selected={this.state.varvalue25day == '08' ? 'selected' : ''}>  08  </option>
       <option value ="09" selected={this.state.varvalue25day == '09' ? 'selected' : ''}>  09  </option>          {
         this.state.day.map(
           data =>
           <option value={data} selected={this.state.varvalue25day == data ? 'selected' : ''}>{data}</option>
         )
         }
         </select>

         <select  onChange={(e) => this.setState({ varvalue25month: e.target.value })}>
         <option value ="">  เดือน  </option>
         <option value ="01"  selected={this.state.varvalue25month == '01' ? 'selected' : ''}>  01  </option>
         <option value ="02"  selected={this.state.varvalue25month == '02' ? 'selected' : ''}>  02  </option>
         <option value ="03"  selected={this.state.varvalue25month == '03' ? 'selected' : ''}>  03  </option>
         <option value ="04"  selected={this.state.varvalue25month == '04' ? 'selected' : ''}>  04  </option>
         <option value ="05"  selected={this.state.varvalue25month == '05' ? 'selected' : ''}>  05  </option>
         <option value ="06"  selected={this.state.varvalue25month == '06' ? 'selected' : ''}>  06  </option>
         <option value ="07"  selected={this.state.varvalue25month == '07' ? 'selected' : ''}>  07  </option>
         <option value ="08"  selected={this.state.varvalue25month == '08' ? 'selected' : ''}>  08  </option>
         <option value ="09"  selected={this.state.varvalue25month == '09' ? 'selected' : ''}>  09  </option>
         {
           this.state.month.map(
             data =>
             <option value={data}  selected={this.state.varvalue25month == data ? 'selected' : ''}>{data}</option>
           )
           }
         </select>
       <select onChange={(e) => this.setState({ varvalue25year: e.target.value })}  >
       <option value ="">  ปี พ.ศ  </option>
       {
         this.state.year.map(
           data =>
           <option value={data}  selected={this.state.varvalue25year == data ? 'selected' : ''}>{data}</option>
         )
         }
       </select>
       </th>
     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>&nbsp;</th>
      <th style={{backgroundColor:'#F4F4F6'}}>&nbsp;</th>
    </tr>
    </thead>
      </table>
      </div>
      </div>


</div>
      </div>
      </div>
      </form>
    }
  }
  columnchangecasepaymentdefault()
  {
    this.setState({
      casepaymentcolumn:0

    })
  }
  columnchangecasepayment()
  {
    this.setState({
      casepaymentcolumn:1

    })
  }
  columnchangecaseassetdefault()
  {
    this.setState({
      caseassetcolumn:0

    })
  }
  columnchangecaseasset()
  {
    this.setState({
      caseassetcolumn:1

    })
  }
  columnchangecasetracking()
  {
    this.setState({
      casetrackingcolumn:1

    })
  }
  columnchangecasetrackingdefault()
  {
    this.setState({
      casetrackingcolumn:0

    })
  }
  columnchangecasedetail()
  {
    this.setState({
      casedetailcolumn:1

    })
  }
  columnchangecasedetaildefault()
  {
    this.setState({
      casedetailcolumn:0

    })
  }
  openModal() {
        this.setState({
            visible : true
        });
    }

    closeModal() {
        this.setState({
            visible : false
        });
    }
  notebutton(data)
  {
    if(data.note_from_previous_case != null ||data.note_to_copy_to_renew_case != null ||data.note_from_member != null ||data.note_from_partner != null ||data.note_from_user != null )
    {
      return <a style={{float:'right',fontSize:'25px',color:'#00325d',padding:'10px'}}onClick={() => this.openModal()}  ><i class="fa fa-edit"><i style={{fontSize:'12px',color:'red',verticalAlign:'top'}} class="fa fa-asterisk"></i></i></a>
    }
    else
    {
      return <a style={{float:'right',fontSize:'25px',color:'#00325d',padding:'10px'}}onClick={() => this.openModal()}  ><i class="fa fa-edit"></i></a>

    }
  }
  cancelbutton(data)
  {
    if(data.var_value130 == null)
    {
      return <button style={{float:'right',padding:'10px'}} type="button" onClick={() => { if (window.confirm('คุณแน่ใจว่าจะยกเลิกงานนี้ ?')) this.cancelcase() } } class="btn btn-box-tool" ><span style={{color:'red',fontSize:'16px'}}>ยกเลิกงาน</span></button>
    }
    else
    {
      return     <button style={{float:'right',padding:'10px'}} type="button"  class="btn btn-box-tool" ><span style={{color:'red',fontSize:'16px'}}>งานนี้ถูกยกเลิกแล้ว({data.cancel_date})</span></button>
    }
  }
  renewbutton(data)
  {
    if(data.renew_case_id == null)
    {
      if(data.var_value130 != null)
      {
        return     <button style={{float:'right',padding:'10px'}} type="button"  class="btn btn-box-tool" ><span style={{color:'green',fontSize:'16px'}}>ไม่สามารถต่ออายุงานได้</span></button>

      }
      return     <button style={{float:'right',padding:'10px'}} type="button"  class="btn btn-box-tool" onClick={() => { if (window.confirm('คุณต้องการต่ออายุงานนี้ ?')) this.renewcase() } }><span style={{color:'#00325d',fontSize:'16px'}}>ต่ออายุงาน</span></button>
    }
    else
    {
      return     <button style={{float:'right',padding:'10px'}} type="button"  class="btn btn-box-tool" ><span style={{color:'green',fontSize:'16px'}}>งานนี้ถูกต่ออายุแล้ว</span></button>
    }
  }
  invoicebutton(data)
  {
    if(this.state.confirmoffer.length > 0)
    {
      return <a style={{float:'right',padding:'10px'}}  target="_blank" href={"/wealththaiinsurance/cases/invoice/"+data.id} class="btn btn-default" ><span >สร้างใบแจ้งหนี้</span></a>
    }
    else
    {
      return
    }
  }
  handleSubmitnoteprevcase(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase',{
      id:this.state.caseid2,
      noteprevcase:this.state.noteprevcase,
      notenextcase:this.state.note_to_copy_to_renew_case,
      notefrommember:this.state.note_from_member,
      notefromuser:this.state.note_from_user,
      notefrompartner:this.state.note_from_partner,
      fixact38:this.state.filvar_value38,
      fixact39:this.state.filvar_value39,
      fixact40:this.state.filvar_value40,
      fixins41:this.state.filvar_value41,
      fixins42:this.state.filvar_value42,
      fixins43:this.state.filvar_value43,
      fixtax44:this.state.filvar_value44,
      fixtax45:this.state.filvar_value45,
      fixtax46:this.state.filvar_value46,
    }).then(res=>{
      console.log("Answer"+res.data);
      this.setState({
       filcase:res.data,
        flagnoteprevcase:0
      })
    });

  }
  opennoteprevcase()
  {
    this.setState({
      flagnoteprevcase:1
    })
  }
  closenoteprevcase()
  {
    this.setState({
      flagnoteprevcase:0
    })
  }
  handleChangenoteprevcase(e){
    console.log(e.target.value);
    this.setState({
      noteprevcase:e.target.value,
    })
  }
  handleChangenotenextcase(e){
    console.log(e.target.value);
    this.setState({
      notenextcase:e.target.value,
    })
  }
  handleChangenotefrommember(e){
    console.log(e.target.value);
    this.setState({
      notefrommember:e.target.value,
    })
  }
  handleChangenotefrompartner(e){
    console.log(e.target.value);
    this.setState({
      notefrompartner:e.target.value,
    })
  }
  handleChangenotefromuser(e){
    console.log(e.target.value);
    this.setState({
      notefromuser:e.target.value,
    })
  }
  noteprevcase(data)
  {
    if(this.state.flagnoteprevcase == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitnoteprevcase}><textarea onChange={this.handleChangenoteprevcase} class="form-control"></textarea><p><button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closenoteprevcase}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></p></form></div>
    }
    else
    {
      return <div ><textarea class="form-control" readOnly>{data.note_from_previous_case}</textarea> <p><button onClick={this.opennoteprevcase} type="button"  class="btn btn-box-tool" ><span style={{color:'orange'}}>แก้ไข</span></button></p></div>
    }
  }
  opennotenextcase()
  {
    this.setState({
      flagnotenextcase:1
    })
  }
  closenotenextcase()
  {
    this.setState({
      flagnotenextcase:0
    })
  }
  handleSubmitnotenextcase(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase',{
      id:this.state.caseid2,
      noteprevcase:this.state.note_from_previous_case,
      notenextcase:this.state.notenextcase,
      notefrommember:this.state.note_from_member,
      notefromuser:this.state.note_from_user,
      notefrompartner:this.state.note_from_partner,
      fixact38:this.state.filvar_value38,
      fixact39:this.state.filvar_value39,
      fixact40:this.state.filvar_value40,
      fixins41:this.state.filvar_value41,
      fixins42:this.state.filvar_value42,
      fixins43:this.state.filvar_value43,
      fixtax44:this.state.filvar_value44,
      fixtax45:this.state.filvar_value45,
      fixtax46:this.state.filvar_value46,
    }).then(res=>{

      console.log(res.data);
      this.setState({
        filcase:res.data,
        flagnotenextcase:0
      })
    });

  }
  notenextcase(data)
  {
    if(this.state.flagnotenextcase == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitnotenextcase}><textarea onChange={this.handleChangenotenextcase} class="form-control"></textarea><p><button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closenotenextcase}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></p></form></div>
    }
    else
    {
      return <div ><textarea class="form-control" readOnly>{data.note_to_copy_to_renew_case}</textarea> <p><button onClick={this.opennotenextcase} type="button"  class="btn btn-box-tool" ><span style={{color:'orange'}}>แก้ไข</span></button></p></div>
    }
  }
  opennotefrommember()
  {
    this.setState({
      flagnotefrommember:1
    })
  }
  closenotefrommember()
  {
    this.setState({
      flagnotefrommember:0
    })
  }
  handleSubmitnotefrommember(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase',{
      id:this.state.caseid2,
      noteprevcase:this.state.note_from_previous_case,
      notenextcase:this.state.note_to_copy_to_renew_case,
      notefrommember:this.state.notefrommember,
      notefromuser:this.state.note_from_user,
      notefrompartner:this.state.note_from_partner,
      fixact38:this.state.filvar_value38,
      fixact39:this.state.filvar_value39,
      fixact40:this.state.filvar_value40,
      fixins41:this.state.filvar_value41,
      fixins42:this.state.filvar_value42,
      fixins43:this.state.filvar_value43,
      fixtax44:this.state.filvar_value44,
      fixtax45:this.state.filvar_value45,
      fixtax46:this.state.filvar_value46,

    }).then(res=>{

      console.log(res.data);
      this.setState({
        filcase:res.data,
        flagnotefrommember:0
      })
    });

  }
  notefrommember(data)
  {
    if(this.state.flagnotefrommember == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitnotefrommember}><textarea onChange={this.handleChangenotefrommember} class="form-control"></textarea><p><button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closenotefrommember}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></p></form></div>
    }
    else
    {
      return <div ><textarea class="form-control" readOnly>{data.note_from_member}</textarea> <p><button onClick={this.opennotefrommember} type="button"  class="btn btn-box-tool" ><span style={{color:'orange'}}>แก้ไข</span></button></p></div>
    }
  }
  handleSubmitnotefrompartner(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase',{
      id:this.state.caseid2,
      noteprevcase:this.state.note_from_previous_case,
      notenextcase:this.state.note_to_copy_to_renew_case,
      notefrommember:this.state.note_from_member,
      notefromuser:this.state.note_from_user,
      notefrompartner:this.state.notefrompartner,
      fixact38:this.state.filvar_value38,
      fixact39:this.state.filvar_value39,
      fixact40:this.state.filvar_value40,
      fixins41:this.state.filvar_value41,
      fixins42:this.state.filvar_value42,
      fixins43:this.state.filvar_value43,
      fixtax44:this.state.filvar_value44,
      fixtax45:this.state.filvar_value45,
      fixtax46:this.state.filvar_value46,
    }).then(res=>{
      console.log(res.data);
      this.setState({
        filcase:res.data,
        flagnotefrompartner:0
      })
    });
  }
  opennotefrompartner()
  {
    this.setState({
      flagnotefrompartner:1
    })
  }
  closenotefrompartner()
  {
    this.setState({
      flagnotefrompartner:0
    })
  }
  notefrompartner(data)
  {
    if(this.state.flagnotefrompartner == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitnotefrompartner}><textarea onChange={this.handleChangenotefrompartner} class="form-control"></textarea><p><button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closenotefrompartner}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></p></form></div>
    }
    else
    {
      return <div ><textarea class="form-control" readOnly>{data.note_from_partner}</textarea> <p><button onClick={this.opennotefrompartner} type="button"  class="btn btn-box-tool" ><span style={{color:'orange'}}>แก้ไข</span></button></p></div>
    }
  }
  handleSubmitnotefromuser(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase',{
      id:this.state.caseid2,
      noteprevcase:this.state.note_from_previous_case,
      notenextcase:this.state.note_to_copy_to_renew_case,
      notefrommember:this.state.note_from_member,
      notefromuser:this.state.notefromuser,
      notefrompartner:this.state.note_from_partner,
      fixact38:this.state.filvar_value38,
      fixact39:this.state.filvar_value39,
      fixact40:this.state.filvar_value40,
      fixins41:this.state.filvar_value41,
      fixins42:this.state.filvar_value42,
      fixins43:this.state.filvar_value43,
      fixtax44:this.state.filvar_value44,
      fixtax45:this.state.filvar_value45,
      fixtax46:this.state.filvar_value46,

    }).then(res=>{

      console.log(res.data);
      this.setState({
        filcase:res.data,
        flagnotefromuser:0
      })
    });
  }
  opennotefromuser()
  {
    this.setState({
      flagnotefromuser:1
    })
  }
  closenotefromuser()
  {
    this.setState({
      flagnotefromuser:0
    })
  }
  notefromuser(data)
  {
    if(this.state.flagnotefromuser == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitnotefromuser}><textarea onChange={this.handleChangenotefromuser} class="form-control"></textarea><p><button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closenotefromuser}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></p></form></div>
    }
    else
    {
      return <div ><textarea class="form-control" readOnly>{data.note_from_user}</textarea> <p><button onClick={this.opennotefromuser} type="button"  class="btn btn-box-tool" ><span style={{color:'orange'}}>แก้ไข</span></button></p></div>
    }
  }
  oldcase(data)
  {
    if(data.ref_previous_case == null)
    {
      return "";
    }
    else
    {
      return  <a onClick={this.backtopreviouscase} style={{color:'blue'}}>รหัสงาน {data.ref_previous_case}</a>
    }
  }
  newcase(data)
  {
    if(data.renew_case_id == null)
    {
      return "";
    }
    else
    {
      return  <a onClick={this.gotorenewcase} style={{color:'blue'}}>รหัสงาน {data.renew_case_id}</a>
    }
  }
  showuser(data){
    if(data.service_user_block_id != null && data.service_user_block_id != 0){
      return  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ผู้ให้บริการ /ผู้แจ้งงาน </th>
             <th style={{backgroundColor:'white'}}>&nbsp;
                 {data.block.name}
                 </th></tr>
    }
    else{
      return '';
    }
  }
  showcoor(data){
    if(data.coordinate_user_block_id != null && data.coordinate_user_block_id != 0){
      return  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ผู้ประสานงาน
                 </th>
                   <th style={{backgroundColor:'white'}}>&nbsp;
                 {data.coordiantor.firstname}
                 </th></tr>
    }
    else{
      return '';
    }
  }
  showpartner(data){
    if(data.consult_partner_block_id == null || data.consult_partner_block_id == 0){
      return 'NOO';
    }
    else{
      return  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ผู้ให้คำปรึกษา/ผู้ให้คำแนะนำ
      </th>
        <th style={{backgroundColor:'white'}}>&nbsp;
      YES
      </th></tr>
    }
  }
  showcasechannel(data){
    if(data.service_user_block_id != null && data.service_user_block_id != 0){
      return  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>เส้นทางรับงาน</th>
             <th style={{backgroundColor:'white'}}>&nbsp;
                 {data.case_channel.name}
                 </th></tr>
    }
    else{
      return '';
    }
  }
  showcasestatus(data){
    if(data.casestatus != null && data.case_status != 0){
      return  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >สถานะงาน</th>
                   <th style={{backgroundColor:'white'}}>&nbsp;{data.case_status.name}</th>
                 </tr>
    }
    else{
      return '';
    }
  }
  showrefasset(data){
    if(data.referal_asset != null && data.referal_asset != 0){
      return  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >สินทรัพย์อ้างอิง</th>
                   <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.name}</th>
                 </tr>
    }
    else{
      return '';
    }
  }
  showrefcase(data){
    if(data.ref_previous_case != null && data.ref_previous_case != 0){
      return  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>งานเดิม
      </th>
        <th style={{backgroundColor:'white'}}>&nbsp;
      {data.cases.name}
      </th></tr>
    }
    else{
      return '';
    }
  }
  stagename(data)
  {
    if(data.stage != null || data.stage != 0)
    {
      return <th style={{backgroundColor:'white'}}>&nbsp;{data.stage.name}</th>
    }
    else
    {
      return <th style={{backgroundColor:'white'}}>&nbsp;</th>
    }
  }
  casedetail(data)
  {
    if(this.state.casedetailcolumn === 0){
      return <div class="column22" id="caseinform">
      <div class={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
      <div class="box-header  ">
        <b class="box-title" data-widget="collapse">รายละเอียดการแจ้งงาน</b>
        <br/>
        <br/>
         <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
         <thead>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
         <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var4}</th>
          <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value4}</th>
         </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
         <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var5}</th>
          <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value5}</th>
         </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
        <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var3}</th>
          <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value3}</th>
        </tr>
          <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
         <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var6}</th>
           <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value6}</th>
         </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
         <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var1}</th>
          <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value1}</th>
         </tr>
         </thead>
         </table>
        <div class="box-tools pull-right">
          <button type="button" onClick={this.columnchangecasedetail} class="btn btn-box-tool" ><i class="fa fa-plus"></i></button>
        </div>
      </div>

      </div>
      </div>
    }
    else{
      return <div class="column" id="caseinform">
      <div class="box" style={{backgroundColor:'#F5F5F5'}}>
      <div class="box-header  ">
        <b class="box-title">รายละเอียดการแจ้งงาน</b>
        <br/>
        <br/>
        <div class="box-tools pull-right">
          <button type="button" onClick={this.columnchangecasedetaildefault} class="btn btn-box-tool" ><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body" >
      <div class="column5">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var1}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value1}</th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var2}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value2}</th>
     </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var3}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value3}</th>
      </tr>



      </thead>
      </table>
      </div>
      <div class="column5">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var4}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value4}</th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var5}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value5}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var6}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value6}</th>
      </tr>
      </thead>
      </table>
      </div>
      <div class="column5">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var7}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value7}</th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var8}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value8}</th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var9}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value9}</th>
     </tr>

      </thead>
      </table>
      </div>
      <div class="column5">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var10}</th>
       <div style={{overflowX:'auto',height:'80px',backgroundColor:'white',border:'0.5px solid #E3E3E3'}}><th style={{backgroundColor:'white'}}>&nbsp;{data.require_value10}</th></div>
     </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var11} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value11}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var12} </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value12}</th>
      </tr>

      </thead>
      </table>
      </div>
      <div class="column5">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var13}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value13}</th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var14} </th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value14}</th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var15}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value15}</th>
     </tr>
      </thead>
      </table>
      </div>
      </div>
      </div>
      </div>
    }

  }
  copyact(data)
  {
    if(this.state.copyact.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.copyact.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA45CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }

  copypaymentact(data)
  {
    if(this.state.actcopypayment.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.actcopypayment.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA51CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  insurancecopy(data)
  {
    if(this.state.insurancecopy.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.insurancecopy.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA46CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  insurancepaymentcopy(data)
  {
    if(this.state.insurancecopypayment.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.insurancecopypayment.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA50CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  insurancepaymenttocompanycopy(data)
  {
    if(this.state.insurancepaymenttocompanycopy.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.insurancepaymenttocompanycopy.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA54CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  actpaymenttocompanycopy(data)
  {
    if(this.state.actpaymenttocompanycopy.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.actpaymenttocompanycopy.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA55CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  taxpaymenttocompanycopy(data)
  {
    if(this.state.taxpaymenttocompanycopy.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.taxpaymenttocompanycopy.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA56CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  taxpaymentcopy(data)
  {
    if(this.state.taxcopypayment.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.taxcopypayment.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA52CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  taxcopy(data)
  {
    if(this.state.taxcopy.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.taxcopy.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA47CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  carphoto(data)
  {
    if(this.state.carphoto.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.carphoto.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let assetid = data.referal_asset;
      let portid =data.asset.port_id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/asset/uploadfile/"+portid+"/"+assetid+"/xxx/CG2CG/Asset_Attachment_"+portid+"_"+assetid+"?cat?CA14CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  carcamera(data)
  {
    if(this.state.carcamera.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.carcamera.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let assetid = data.referal_asset;
      let portid =data.asset.port_id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/asset/uploadfile/"+portid+"/"+assetid+"/xxx/CG2CG/Asset_Attachment_"+portid+"_"+assetid+"?cat?CA44CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
///////////// Edit Data
handleChangefixact38(e){
  console.log(e.target.value);
  this.setState({
    fixact38:e.target.value,
  })
}

handleSubmitfixact38(e){
  e.preventDefault();
  axios.post('/wealththaiinsurance/update/somecase',{
    id:this.state.caseid2,
    noteprevcase:this.state.data.note_from_previous_case,
    notenextcase:this.state.data.note_to_copy_to_renew_case,
    notefrommember:this.state.data.note_from_member,
    notefromuser:this.state.data.note_from_user,
    notefrompartner:this.state.data.note_from_partner,
    fixact38:this.state.fixact38,
    fixact39:this.state.data.var_value39,
    fixact40:this.state.data.var_value40,
    fixins41:this.state.data.var_value41,
    fixins42:this.state.data.var_value42,
    fixins43:this.state.data.var_value43,
    fixtax44:this.state.data.var_value44,
    fixtax45:this.state.data.var_value45,
    fixtax46:this.state.data.var_value46,
  }).then(res=>{

    console.log(res.data);
    this.setState({
      filcase:res.data,
      flagfixact38:0
    })
    res.data.map( data=>this.state.data = data)
  });

}
openfixact38()
{
  this.setState({
    flagfixact38:1
  })
}
closefixact38()
{
  this.setState({
    flagfixact38:0
  })
}
fixact38(data)
{
  if(this.state.flagfixact38 == 1)
  {
    return  <div> <form onSubmit={this.handleSubmitfixact38}><input  onChange={this.handleChangefixact38} value={this.state.fixact38} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixact38}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
  }
  else
  {
    return <div ><span style={{float:'left'}}>{data.var_value38}</span> <span style={{float:'right',color:'orange'}}  onClick={this.openfixact38}>แก้ไข</span></div>
  }
}
handleChangefixact39(e){
  console.log(e.target.value);
  this.setState({
    fixact39:e.target.value,
  })
}
handleSubmitfixact39(e){
  e.preventDefault();
  axios.post('/wealththaiinsurance/update/somecase',{
    id:this.state.caseid2,
    noteprevcase:this.state.data.note_from_previous_case,
    notenextcase:this.state.data.note_to_copy_to_renew_case,
    notefrommember:this.state.data.note_from_member,
    notefromuser:this.state.data.note_from_user,
    notefrompartner:this.state.data.note_from_partner,
    fixact38:this.state.data.var_value38,
    fixact39:this.state.fixact39,
    fixact40:this.state.data.var_value40,
    fixins41:this.state.data.var_value41,
    fixins42:this.state.data.var_value42,
    fixins43:this.state.data.var_value43,
    fixtax44:this.state.data.var_value44,
    fixtax45:this.state.data.var_value45,
    fixtax46:this.state.data.var_value46,
  }).then(res=>{

    console.log(res.data);
    this.setState({
      filcase:res.data,
      flagfixact39:0
    })
    res.data.map( data=>this.state.data = data)
  });

}
openfixact39()
{
  this.setState({
    flagfixact39:1
  })
}
closefixact39()
{
  this.setState({
    flagfixact39:0
  })
}
fixact39(data)
{
  if(this.state.flagfixact39 == 1)
  {
    return  <div> <form onSubmit={this.handleSubmitfixact39}><input onChange={this.handleChangefixact39} value={this.state.fixact39} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixact39}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
  }
  else
  {
    return <div ><span style={{float:'left'}}>{data.var_value39}</span> <span style={{float:'right',color:'orange'}}  onClick={this.openfixact39}>แก้ไข</span></div>
  }
}
handleChangefixact40(e){
  console.log(e.target.value);
  this.setState({
    fixact40:e.target.value,
  })
}
handleSubmitfixact40(e){
  e.preventDefault();
  axios.post('/wealththaiinsurance/update/somecase',{
    id:this.state.caseid2,
    noteprevcase:this.state.data.note_from_previous_case,
    notenextcase:this.state.data.note_to_copy_to_renew_case,
    notefrommember:this.state.data.note_from_member,
    notefromuser:this.state.data.note_from_user,
    notefrompartner:this.state.data.note_from_partner,
    fixact38:this.state.data.var_value38,
    fixact39:this.state.data.var_value39,
    fixact40:this.state.day40+'/'+this.state.month40+'/'+this.state.year40,
    fixins41:this.state.data.var_value41,
    fixins42:this.state.data.var_value42,
    fixins43:this.state.data.var_value43,
    fixtax44:this.state.data.var_value44,
    fixtax45:this.state.data.var_value45,
    fixtax46:this.state.data.var_value46,
  }).then(res=>{

    console.log(res.data);
    this.setState({
      filcase:res.data,
      flagfixact40:0
    })
    res.data.map( data=>this.state.data = data)
  });

}
openfixact40()
{
  this.setState({
    flagfixact40:1
  })
}
closefixact40()
{
  this.setState({
    flagfixact40:0
  })
}
fixact40(data)
{
  if(this.state.flagfixact40 == 1)
  {
    return  <div> <form onSubmit={this.handleSubmitfixact40}>
    <select onChange={(e) => this.setState({ day40: e.target.value })} name="dayex">
    <option value ="">  วัน  </option>
    <option value ="01">  01  </option>
    <option value ="02">  02  </option>
    <option value ="03">  03  </option>
    <option value ="04">  04  </option>
    <option value ="05">  05  </option>
    <option value ="06">  06  </option>
    <option value ="07">  07  </option>
    <option value ="08">  08  </option>
    <option value ="09">  09  </option>          {
      this.state.day.map(
        data =>
        <option value={data}>{data}</option>
      )
      }
      </select>

      <select  onChange={(e) => this.setState({ month40: e.target.value })}>
      <option value ="">  เดือน  </option>
      <option value ="01">  01  </option>
      <option value ="02">  02  </option>
      <option value ="03">  03  </option>
      <option value ="04">  04  </option>
      <option value ="05">  05  </option>
      <option value ="06">  06  </option>
      <option value ="07">  07  </option>
      <option value ="08">  08  </option>
      <option value ="09">  09  </option>
      {
        this.state.month.map(
          data =>
          <option value={data}>{data}</option>
        )
        }
      </select>
    <select onChange={(e) => this.setState({ year40: e.target.value })}  >
    <option value ="">  ปี พ.ศ  </option>
    {
      this.state.year.map(
        data =>
        <option value={data}>{data}</option>
      )
      }
    </select>
    &nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixact40}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
  }
  else
  {
    return <div ><span style={{float:'left'}}>{data.var_value40}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixact40}>แก้ไข</span></div>
  }
}
handleChangefixins41(e){
  console.log(e.target.value);
  this.setState({
    fixins41:e.target.value,
  })
}
handleSubmitfixins41(e){
  e.preventDefault();
  axios.post('/wealththaiinsurance/update/somecase',{
    id:this.state.caseid2,
    noteprevcase:this.state.data.note_from_previous_case,
    notenextcase:this.state.data.note_to_copy_to_renew_case,
    notefrommember:this.state.data.note_from_member,
    notefromuser:this.state.data.note_from_user,
    notefrompartner:this.state.data.note_from_partner,
    fixact38:this.state.data.var_value38,
    fixact39:this.state.data.var_value39,
    fixact40:this.state.data.var_value40,
    fixtax44:this.state.data.var_value44,
    fixtax45:this.state.data.var_value45,
    fixtax46:this.state.data.var_value46,
    fixins41:this.state.fixins41,
    fixins42:this.state.data.var_value42,
    fixins43:this.state.data.var_value43,

  }).then(res=>{

    console.log(res.data);
    this.setState({
      filcase:res.data,
      flagfixins41:0
    })
    res.data.map( data=>this.state.data = data)

  });

}
openfixins41()
{
  this.setState({
    flagfixins41:1
  })
}
closefixins41()
{
  this.setState({
    flagfixins41:0
  })
}
fixins41(data)
{
  if(this.state.flagfixins41 == 1)
  {
    return  <div> <form onSubmit={this.handleSubmitfixins41}><input onChange={this.handleChangefixins41} value={this.state.fixins41} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins41}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
  }
  else
  {
    return <div ><span style={{float:'left'}}>{data.var_value41}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins41}>แก้ไข</span></div>
  }
}
handleChangefixins42(e){
  console.log(e.target.value);
  this.setState({
    fixins42:e.target.value,
  })
}
handleSubmitfixins42(e){
  e.preventDefault();
  axios.post('/wealththaiinsurance/update/somecase',{
    id:this.state.caseid2,
    noteprevcase:this.state.data.note_from_previous_case,
    notenextcase:this.state.data.note_to_copy_to_renew_case,
    notefrommember:this.state.data.note_from_member,
    notefromuser:this.state.data.note_from_user,
    notefrompartner:this.state.data.note_from_partner,
    fixact38:this.state.data.var_value38,
    fixact39:this.state.data.var_value39,
    fixact40:this.state.data.var_value40,
    fixtax44:this.state.data.var_value44,
    fixtax45:this.state.data.var_value45,
    fixtax46:this.state.data.var_value46,
    fixins41:this.state.data.var_value41,
    fixins42:this.state.fixins42,
    fixins43:this.state.data.var_value43,

  }).then(res=>{

    console.log(res.data);
    this.setState({
      filcase:res.data,
      flagfixins42:0
    })
    res.data.map( data=>this.state.data = data)

  });

}
openfixins42()
{
  this.setState({
    flagfixins42:1
  })
}
closefixins42()
{
  this.setState({
    flagfixins42:0
  })
}
fixins42(data)
{
  if(this.state.flagfixins42 == 1)
  {
    return  <div> <form onSubmit={this.handleSubmitfixins42}><input onChange={this.handleChangefixins42} value={this.state.fixins42} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins42}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
  }
  else
  {
    return <div ><span style={{float:'left'}}>{data.var_value42}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins42}>แก้ไข</span></div>
  }
}
handleChangefixins43(e){
  console.log(e.target.value);
  this.setState({
    fixins43:e.target.value,
  })
}
handleSubmitfixins43(e){
  e.preventDefault();
  axios.post('/wealththaiinsurance/update/somecase',{
    id:this.state.caseid2,
    noteprevcase:this.state.data.note_from_previous_case,
    notenextcase:this.state.data.note_to_copy_to_renew_case,
    notefrommember:this.state.data.note_from_member,
    notefromuser:this.state.data.note_from_user,
    notefrompartner:this.state.data.note_from_partner,
    fixact38:this.state.data.var_value38,
    fixact39:this.state.data.var_value39,
    fixact40:this.state.data.var_value40,
    fixtax44:this.state.data.var_value44,
    fixtax45:this.state.data.var_value45,
    fixtax46:this.state.data.var_value46,
    fixins41:this.state.data.var_value41,
    fixins42:this.state.data.var_value42,
    fixins43:this.state.day43+'/'+this.state.month43+'/'+this.state.year43,

  }).then(res=>{

    console.log(res.data);
    this.setState({
      filcase:res.data,
      flagfixins43:0
    })
    res.data.map( data=>this.state.data = data)

  });

}
openfixins43()
{
  this.setState({
    flagfixins43:1
  })
}
closefixins43()
{
  this.setState({
    flagfixins43:0
  })
}
fixins43(data)
{
  if(this.state.flagfixins43 == 1)
  {
    return  <div> <form onSubmit={this.handleSubmitfixins43}>
    <select onChange={(e) => this.setState({ day43: e.target.value })} name="dayex">
    <option value ="">  วัน  </option>
    <option value ="01">  01  </option>
    <option value ="02">  02  </option>
    <option value ="03">  03  </option>
    <option value ="04">  04  </option>
    <option value ="05">  05  </option>
    <option value ="06">  06  </option>
    <option value ="07">  07  </option>
    <option value ="08">  08  </option>
    <option value ="09">  09  </option>          {
      this.state.day.map(
        data =>
        <option value={data}>{data}</option>
      )
      }
      </select>

      <select  onChange={(e) => this.setState({ month43: e.target.value })}>
      <option value ="">  เดือน  </option>
      <option value ="01">  01  </option>
      <option value ="02">  02  </option>
      <option value ="03">  03  </option>
      <option value ="04">  04  </option>
      <option value ="05">  05  </option>
      <option value ="06">  06  </option>
      <option value ="07">  07  </option>
      <option value ="08">  08  </option>
      <option value ="09">  09  </option>
      {
        this.state.month.map(
          data =>
          <option value={data}>{data}</option>
        )
        }
      </select>
    <select onChange={(e) => this.setState({ year43: e.target.value })}  >
    <option value ="">  ปี พ.ศ  </option>
    {
      this.state.year.map(
        data =>
        <option value={data}>{data}</option>
      )
      }
    </select>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins43}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
  }
  else
  {
    return <div ><span style={{float:'left'}}>{data.var_value43}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins43}>แก้ไข</span></div>
  }
}

handleChangefixtax44(e){
  console.log(e.target.value);
  this.setState({
    fixtax44:e.target.value,
  })
}
handleSubmitfixtax44(e){
  e.preventDefault();
  axios.post('/wealththaiinsurance/update/somecase',{
    id:this.state.caseid2,
    noteprevcase:this.state.data.note_from_previous_case,
    notenextcase:this.state.data.note_to_copy_to_renew_case,
    notefrommember:this.state.data.note_from_member,
    notefromuser:this.state.data.note_from_user,
    notefrompartner:this.state.data.note_from_partner,
    fixact38:this.state.data.var_value38,
    fixact39:this.state.data.var_value39,
    fixact40:this.state.data.var_value40,
    fixins41:this.state.data.var_value41,
    fixins42:this.state.data.var_value42,
    fixins43:this.state.data.var_value43,
    fixtax44:this.state.fixtax44,
    fixtax45:this.state.data.var_value45,
    fixtax46:this.state.data.var_value46,

  }).then(res=>{

    console.log(res.data);
    this.setState({
      filcase:res.data,
      flagfixtax44:0
    })
    res.data.map( data=>this.state.data = data)

  });

}
openfixtax44()
{
  this.setState({
    flagfixtax44:1
  })
}
closefixtax44()
{
  this.setState({
    flagfixtax44:0
  })
}
fixtax44(data)
{
  if(this.state.flagfixtax44 == 1)
  {
    return  <div> <form onSubmit={this.handleSubmitfixtax44}><input onChange={this.handleChangefixtax44} value={this.state.fixtax44} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixtax44}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
  }
  else
  {
    return <div ><span style={{float:'left'}}>{data.var_value44}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixtax44}>แก้ไข</span></div>
  }
}


handleChangefixtax45(e){
  console.log(e.target.value);
  this.setState({
    fixtax45:e.target.value,
  })
}
handleSubmitfixtax45(e){
  e.preventDefault();
  axios.post('/wealththaiinsurance/update/somecase',{
    id:this.state.caseid2,
    noteprevcase:this.state.data.note_from_previous_case,
    notenextcase:this.state.data.note_to_copy_to_renew_case,
    notefrommember:this.state.data.note_from_member,
    notefromuser:this.state.data.note_from_user,
    notefrompartner:this.state.data.note_from_partner,
    fixact38:this.state.data.var_value38,
    fixact39:this.state.data.var_value39,
    fixact40:this.state.data.var_value40,
    fixins41:this.state.data.var_value41,
    fixins42:this.state.data.var_value42,
    fixins43:this.state.data.var_value43,
    fixtax44:this.state.data.var_value44,
    fixtax45:this.state.fixtax45,
    fixtax46:this.state.data.var_value46,

  }).then(res=>{

    console.log(res.data);
    this.setState({
      filcase:res.data,
      flagfixtax45:0
    })
    res.data.map( data=>this.state.data = data)

  });

}
openfixtax45()
{
  this.setState({
    flagfixtax45:1
  })
}
closefixtax45()
{
  this.setState({
    flagfixtax45:0
  })
}
fixtax45(data)
{
  if(this.state.flagfixtax45 == 1)
  {
    return  <div> <form onSubmit={this.handleSubmitfixtax45}><input onChange={this.handleChangefixtax45} value={this.state.fixtax45} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixtax45}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
  }
  else
  {
    return <div ><span style={{float:'left'}}>{data.var_value45}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixtax45}>แก้ไข</span></div>
  }
}

handleChangefixtax46(e){
  console.log(e.target.value);
  this.setState({
    fixtax46:e.target.value,
  })
}
handleSubmitfixtax46(e){
  e.preventDefault();
  axios.post('/wealththaiinsurance/update/somecase',{
    id:this.state.caseid2,
    noteprevcase:this.state.data.note_from_previous_case,
    notenextcase:this.state.data.note_to_copy_to_renew_case,
    notefrommember:this.state.data.note_from_member,
    notefromuser:this.state.data.note_from_user,
    notefrompartner:this.state.data.note_from_partner,
    fixact38:this.state.data.var_value38,
    fixact39:this.state.data.var_value39,
    fixact40:this.state.data.var_value40,
    fixins41:this.state.data.var_value41,
    fixins42:this.state.data.var_value42,
    fixins43:this.state.data.var_value43,
    fixtax44:this.state.data.var_value44,
    fixtax45:this.state.data.var_value45,
    fixtax46:this.state.day46+'/'+this.state.month46+'/'+this.state.year46,

  }).then(res=>{

    console.log(res.data);
    this.setState({
      filcase:res.data,
      flagfixtax46:0
    })
    res.data.map( data=>this.state.data = data)

  });

}
openfixtax46()
{
  this.setState({
    flagfixtax46:1
  })
}
closefixtax46()
{
  this.setState({
    flagfixtax46:0
  })
}
fixtax46(data)
{
  if(this.state.flagfixtax46 == 1)
  {
    return  <div> <form onSubmit={this.handleSubmitfixtax46}>
    <select onChange={(e) => this.setState({ day46: e.target.value })} name="dayex">
    <option value ="">  วัน  </option>
    <option value ="01">  01  </option>
    <option value ="02">  02  </option>
    <option value ="03">  03  </option>
    <option value ="04">  04  </option>
    <option value ="05">  05  </option>
    <option value ="06">  06  </option>
    <option value ="07">  07  </option>
    <option value ="08">  08  </option>
    <option value ="09">  09  </option>          {
      this.state.day.map(
        data =>
        <option value={data}>{data}</option>
      )
      }
      </select>

      <select  onChange={(e) => this.setState({ month46: e.target.value })}>
      <option value ="">  เดือน  </option>
      <option value ="01">  01  </option>
      <option value ="02">  02  </option>
      <option value ="03">  03  </option>
      <option value ="04">  04  </option>
      <option value ="05">  05  </option>
      <option value ="06">  06  </option>
      <option value ="07">  07  </option>
      <option value ="08">  08  </option>
      <option value ="09">  09  </option>
      {
        this.state.month.map(
          data =>
          <option value={data}>{data}</option>
        )
        }
      </select>
    <select onChange={(e) => this.setState({ year46: e.target.value })}  >
    <option value ="">  ปี พ.ศ  </option>
    {
      this.state.year.map(
        data =>
        <option value={data}>{data}</option>
      )
      }
    </select>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixtax46}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
  }
  else
  {
    return <div ><span style={{float:'left'}}>{data.var_value46}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixtax46}>แก้ไข</span></div>
  }
}
//////////// Edit Date

caseasset(data)
{
  if(this.state.caseassetcolumn === 0)
  {

  return            <div class="column2" id="infoasset">
             <div class={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
             <div class="box-header  ">
               <b class="box-title" >ข้อมูลสินทรัพย์</b>
               <br/>
               <br/>


                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>

                           <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                          <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >ทะเบียนรถ</th>
                            <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.ref_name}</th>
                          </tr>
                          <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                         <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >ยี่ห้อ</th>
                           <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.ref_info3}</th>
                         </tr>
                          <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                         <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >รุ่น</th>
                           <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.ref_info4}</th>
                         </tr>
                         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                        <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >รุ่นปี (ค.ศ.)</th>
                          <th style={{backgroundColor:'white'}}>&nbsp;{data.asset.ref_info5}</th>
                        </tr>
                          </thead>
                </table>
               <div class="box-tools pull-right">
                 <button type="button" onClick={this.columnchangecaseasset} class="btn btn-box-tool" ><i class="fa fa-plus"></i></button>
               </div>
             </div>

             </div>
             </div>

           }
           else
           {
             return <div class="column" id="infoasset">
                       <div class="box " style={{backgroundColor:'#F5F5F5'}}>
                       <div class="box-header  ">
                         <b class="box-title" >ข้อมูลสินทรัพย์</b>
                         <br/>
                         <br/>
                         <div class="box-tools pull-right">
                           <button type="button" class="btn btn-box-tool" onClick={this.columnchangecaseassetdefault} ><i class="fa fa-minus"></i></button>
                         </div>
                       </div>
                       <div class="box-body" >

                       {this.showassetdetail(data)}
                       </div>
                       </div>
                       </div>
           }
}
openfixpaymentdetail()
{
  this.state.varvalue26 = this.state.data.var_value26;
  this.state.varvalue27 = this.state.data.var_value27;
  this.state.varvalue28 = this.state.data.var_value28;
  this.state.varvalue29 = this.state.data.var_value29;
  this.state.varvalue30 = this.state.data.var_value30;
  this.state.varvalue31 = this.state.data.var_value31;
  this.state.varvalue32 = this.state.data.var_value32;
  this.state.varvalue33 = this.state.data.var_value33;
  this.state.varvalue34 = this.state.data.var_value34;
  this.state.varvalue35 = this.state.data.var_value35;
  this.state.varvalue36 = this.state.data.var_value36;
  this.state.varvalue37 = this.state.data.var_value37;

  this.setState({
      fixpaymentdetailflag : 1,
  });
}

closefixpaymentdetail()
{
  this.setState({
        fixpaymentdetailflag : 0,
    });
}
casepayment(data,confirmofferinsurancename,confirmofferact,confirmoffertax,confirmofferpayment4,confirmofferpayment4act,confirmofferpayment4tax,confirmofferpayment5tax,confirmofferpayment5act,confirmofferpayment5,alldiscount,alldiscountact,alldiscounttax,beforediscount,beforediscountact,beforediscounttax,afterdiscount,afterdiscountact,afterdiscounttax,allpartnerpaid,allpartnerpaidact,allpartnerpaidtax,alluserpaid,alluserpaidact,alluserpaidtax,allcompanypaid,allcompanypaidact,allcompanypaidtax)
{
  if(this.state.casepaymentcolumn === 0)
  {
    return <div class="column2" id="paymentdetail">
    <div class={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
    <div class="box-header  ">
      <b class="box-title" >รายละเอียดการชำระเงิน</b>
      <br/>
      <br/>
       <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
       <thead>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name28}</th>
        <th style={{backgroundColor:'white'}}>{data.var_value28}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name51}</th>
        <th style={{backgroundColor:'white'}}>{data.var_value51}</th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name52}</th>
       <th style={{backgroundColor:'white'}}>{data.var_value52}</th>
     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name53}</th>
      <th style={{backgroundColor:'white'}}>{data.var_value53}</th>
    </tr>
      </thead>
       </table>
      <div class="box-tools pull-right">
        <button type="button" onClick={this.columnchangecasepayment} class="btn btn-box-tool" ><i class="fa fa-plus"></i></button>
      </div>
    </div>
    <div class="box-body" style={{}}>
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >{data.case_type.var_name26}</th>
      <th style={{backgroundColor:'white'}}>{data.var_value26}</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name27}</th>
      <th style={{backgroundColor:'white'}}>{data.var_value27}</th>
    </tr>

     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name30}</th>
      <th style={{backgroundColor:'white'}}>{data.var_value30}</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name31}</th>
      <th style={{backgroundColor:'white'}}>{data.var_value31}</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>บริษััทประกันที่เลือก(ใหม่)</th>
      <th style={{backgroundColor:'white'}}></th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>เบี้ยรวมหน้าตั๋ว</th>
      <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</th>
      <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ส่วนลดพิเศษทั้งหมด </th>
      <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</th>
      <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</th>
      <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </th>
      <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User) *</th>
      <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company) *</th>
      <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name32}</th>
      <th style={{backgroundColor:'white'}}>{data.var_value32}</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name33}</th>
      <th style={{backgroundColor:'white'}}>{data.var_value33}</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name34}</th>
      <th style={{backgroundColor:'white'}}>{data.var_value34}</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name35}</th>
      <th style={{backgroundColor:'white'}}>{data.var_value35}</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name36}</th>
      <th style={{backgroundColor:'white'}}>{data.var_value36}</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name37}</th>
      <th style={{backgroundColor:'white'}}>{data.var_value37}</th>
    </tr>
    </thead>

    </table>
    </div>
    </div>
    </div>
  }
  else {
    return <div>{this.showfixpaydetail(data,confirmofferinsurancename,confirmofferact,confirmoffertax,confirmofferpayment4,confirmofferpayment4act,confirmofferpayment4tax,confirmofferpayment5tax,confirmofferpayment5act,confirmofferpayment5,alldiscount,alldiscountact,alldiscounttax,beforediscount,beforediscountact,beforediscounttax,afterdiscount,afterdiscountact,afterdiscounttax,allpartnerpaid,allpartnerpaidact,allpartnerpaidtax,alluserpaid,alluserpaidact,alluserpaidtax,allcompanypaid,allcompanypaidact,allcompanypaidtax)}</div>
  }
}
submitcasepayment(e){
  e.preventDefault();
  axios.post('/wealththaiinsurance/update/casepayment',{
    id:this.state.data.id,
    varvalue26:this.state.varvalue26,
    varvalue27:this.state.varvalue27,
    varvalue28:this.state.varvalue28,
    varvalue29:this.state.varvalue29,
    varvalue30:this.state.varvalue30,
    varvalue31:this.state.varvalue31,
    varvalue32:this.state.varvalue32,
    varvalue33:this.state.varvalue33,
    varvalue34:this.state.varvalue34,
    varvalue35:this.state.varvalue35,
    varvalue36:this.state.varvalue36,
    varvalue37:this.state.varvalue37,
  }).then(res=>{

    console.log(res.data);
    this.setState({
      filcase:res.data,
      fixpaymentdetailflag:0,

    })
    res.data.map( data=>this.state.data = data)
  });
}
showfixpaydetail(data,confirmofferinsurancename,confirmofferact,confirmoffertax,confirmofferpayment4,confirmofferpayment4act,confirmofferpayment4tax,confirmofferpayment5tax,confirmofferpayment5act,confirmofferpayment5,alldiscount,alldiscountact,alldiscounttax,beforediscount,beforediscountact,beforediscounttax,afterdiscount,afterdiscountact,afterdiscounttax,allpartnerpaid,allpartnerpaidact,allpartnerpaidtax,alluserpaid,alluserpaidact,alluserpaidtax,allcompanypaid,allcompanypaidact,allcompanypaidtax)
{
  if(this.state.fixpaymentdetailflag == 1)
  {
    return <form onSubmit={this.submitcasepayment}>
    <div class="column" id="paymentdetail">
    <div class="box " style={{backgroundColor:'#F5F5F5'}}>
    <div class="box-header  ">
      <b class="box-title" >รายละเอียดการชำระเงิน</b>
      <br/>
      <br/>
      <div class="box-tools pull-right">
      <button type="submit" class="btn btn-box-tool" ><span style={{color:'green'}} >บันทึก</span></button>
      <button type="button" onClick={this.closefixpaymentdetail}class="btn btn-box-tool" ><span style={{color:'red'}} >ยกเลิก</span></button>
        <button type="button" onClick={this.columnchangecasepaymentdefault} class="btn btn-box-tool" ><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body" >
    <div class="columnshow2">
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name28}</th>
     <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue28: e.target.value })} value={this.state.varvalue28}/></th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name29}</th>
     <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue29: e.target.value })} value={this.state.varvalue29}/></th>
   </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}  >{data.case_type.var_name26}</th>
      <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue26: e.target.value })} value={this.state.varvalue26}/></th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name27}</th>
      <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue27: e.target.value })} value={this.state.varvalue27}/></th>
    </tr>

     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name30}</th>
      <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue30: e.target.value })} value={this.state.varvalue30}/></th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name31}</th>
     <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue31: e.target.value })} value={this.state.varvalue31}/></th>
   </tr>
    </thead>

    </table>
    </div>
    <div class="columnshow2">
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>

     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name32}</th>
      <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue32: e.target.value })} value={this.state.varvalue32}/></th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name33}</th>
      <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue33: e.target.value })} value={this.state.varvalue33}/></th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name34}</th>
      <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue34: e.target.value })} value={this.state.varvalue34}/></th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name35}</th>
      <th style={{backgroundColor:'white'}}>
      <select onChange={(e) => this.setState({ varvalue35: e.target.value })} style={{width:'150px'}} class="form-control">
      <option value ="" selected={this.state.varvalue35 == null ? 'selected' : ''}>  กรุณาเลือก </option>
      <option value ="0" selected={this.state.varvalue35 == '0' ? 'selected' : ''}>  ตัด Net  </option>
      <option value ="1" selected={this.state.varvalue35 == '1' ? 'selected' : ''}>  รับคอมมิชชั่นทีหลัง  </option>
      </select>
      </th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name36}</th>
      <th style={{backgroundColor:'white'}}>
      <select onChange={(e) => this.setState({ varvalue36: e.target.value })} style={{width:'150px'}} class="form-control">
      <option value ="" selected={this.state.varvalue36 == null ? 'selected' : ''}>  กรุณาเลือก </option>
      <option value ="0" selected={this.state.varvalue36 == '0' ? 'selected' : ''}>  ตัด Net  </option>
      <option value ="1" selected={this.state.varvalue36 == '1' ? 'selected' : ''}>  รับคอมมิชชั่นทีหลัง  </option>
      </select>
      </th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name37}</th>
     <th style={{backgroundColor:'white'}}>
     <select onChange={(e) => this.setState({ varvalue37: e.target.value })} style={{width:'150px'}} class="form-control">
     <option value ="" selected={this.state.varvalue37 == null ? 'selected' : ''}>  กรุณาเลือก </option>
     <option value ="0" selected={this.state.varvalue37 == '0' ? 'selected' : ''}>  ตัด Net  </option>
     <option value ="1" selected={this.state.varvalue37 == '1' ? 'selected' : ''}>  รับคอมมิชชั่นทีหลัง  </option>
     </select>
     </th>

   </tr>
    </thead>

    </table>
    </div>
    <div class="column3">
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>

    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>บริษััทประกันที่เลือก(ใหม่)กรมธรรม์</th>
     <th style={{backgroundColor:'white'}}>{confirmofferinsurancename} </th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>เบี้ยรวมหน้าตั๋ว</th>
     <th style={{backgroundColor:'white'}}>{confirmofferpayment4}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</th>
     <th style={{backgroundColor:'white'}}>{confirmofferpayment5}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ส่วนลดพิเศษทั้งหมด </th>
     <th style={{backgroundColor:'white'}}>{alldiscount}</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{beforediscount}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{afterdiscount}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </th>
    <th style={{backgroundColor:'white'}}>{allpartnerpaid}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User) *</th>
    <th style={{backgroundColor:'white'}}>{alluserpaid}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company) *</th>
    <th style={{backgroundColor:'white'}}>{allcompanypaid}</th>
  </tr>
    </thead>

    </table>
    </div>
    <div class="column3">
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>บริษััทประกันที่เลือก(ใหม่)พรบ</th>
     <th style={{backgroundColor:'white'}}>{confirmofferact} </th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>เบี้ยรวมหน้าตั๋ว</th>
     <th style={{backgroundColor:'white'}}>{confirmofferpayment4act}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</th>
     <th style={{backgroundColor:'white'}}>{confirmofferpayment5act}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ส่วนลดพิเศษทั้งหมด </th>
     <th style={{backgroundColor:'white'}}>{alldiscountact}</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{beforediscountact}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{afterdiscountact}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </th>
    <th style={{backgroundColor:'white'}}>{allpartnerpaidact}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User) *</th>
    <th style={{backgroundColor:'white'}}>{alluserpaidact}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company) *</th>
    <th style={{backgroundColor:'white'}}>{allcompanypaidact}</th>
  </tr>

    </thead>

    </table>
    </div>
    <div class="column3">
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>บริษััทประกันที่เลือก(ใหม่)ภาษี</th>
     <th style={{backgroundColor:'white'}}>{confirmoffertax} </th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>เบี้ยรวมหน้าตั๋ว</th>
     <th style={{backgroundColor:'white'}}>{confirmofferpayment4tax}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</th>
     <th style={{backgroundColor:'white'}}>{confirmofferpayment5tax}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ส่วนลดพิเศษทั้งหมด </th>
     <th style={{backgroundColor:'white'}}>{alldiscounttax}</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{beforediscounttax}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{afterdiscounttax}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </th>
    <th style={{backgroundColor:'white'}}>{allpartnerpaidtax}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User) *</th>
    <th style={{backgroundColor:'white'}}>{alluserpaidtax}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company) *</th>
    <th style={{backgroundColor:'white'}}>{allcompanypaidtax}</th>
  </tr>

    </thead>

    </table>
    </div>
    </div>
    </div>
    </div>
    </form>
  }
  else
  {
    let allcalinsurance = Number(confirmofferpayment4)+Number(confirmofferpayment4act)+Number(confirmofferpayment4tax);
    allcalinsurance = allcalinsurance.toFixed(2);
    let allofferpayment5 = Number(confirmofferpayment5)+Number(confirmofferpayment5act)+Number(confirmofferpayment5tax);
    allofferpayment5 = allofferpayment5.toFixed(2);
    let alldiscountcal = Number(alldiscount)+Number(alldiscountact)+Number(alldiscounttax);
    alldiscountcal = alldiscountcal.toFixed(2);
    let beforediscountall = Number(beforediscount)+Number(beforediscountact)+Number(beforediscounttax);
    beforediscountall = beforediscountall.toFixed(2);
    let afterdiscountall = Number(afterdiscount)+Number(afterdiscountact)+Number(afterdiscounttax);
    afterdiscountall = afterdiscountall.toFixed(2);
    let allpartnerpaidcal = Number(allpartnerpaid)+Number(allpartnerpaidact)+Number(allpartnerpaidtax);
    allpartnerpaidcal = allpartnerpaidcal.toFixed(2);
    let alluserpaidcal = Number(alluserpaid)+Number(alluserpaidact)+Number(alluserpaidtax);
    alluserpaidcal = alluserpaidcal.toFixed(2);
    let allcompanypaidcal = Number(allcompanypaid)+Number(allcompanypaidact)+Number(allcompanypaidtax);
    allcompanypaidcal = allcompanypaidcal.toFixed(2);
    return  <div class="column" id="paymentdetail">
    <div class="box " style={{backgroundColor:'#F5F5F5'}}>
    <div class="box-header  ">
      <b class="box-title" >รายละเอียดการชำระเงิน</b>
      <br/>
      <br/>
      <div class="box-tools pull-right">
      <button type="button" onClick={this.openfixpaymentdetail} class="btn btn-box-tool" ><i style={{color:'orange'}} class="fa fa-gear"></i></button>
        <button type="button" onClick={this.columnchangecasepaymentdefault} class="btn btn-box-tool" ><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body" >
    <div class="column4">
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th colSpan="2" style={{backgroundColor:'white',width:'200px',height:'',textAlign:'center',fontSize:'20px'}}>ข้อมูลกรมธรรม์</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name28}</th>
     <th style={{backgroundColor:'white'}}>{data.var_value28}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name29}</th>
     <th style={{backgroundColor:'white'}}>{data.var_value29}</th>
   </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}  >{data.case_type.var_name26}</th>
      <th style={{backgroundColor:'white'}}>{data.var_value26}</th>

    </tr>

    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>บริษััทประกันที่เลือก(ใหม่)กรมธรรม์</th>
     <th style={{backgroundColor:'white'}}>{confirmofferinsurancename} </th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>เบี้ยรวมหน้าตั๋ว</th>
     <th style={{backgroundColor:'white'}}>{confirmofferpayment4}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</th>
     <th style={{backgroundColor:'white'}}>{confirmofferpayment5}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ส่วนลดพิเศษทั้งหมด </th>
     <th style={{backgroundColor:'white'}}>{alldiscount}</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name32}</th>
    <th style={{backgroundColor:'white'}}>{data.var_value32}</th>
  </tr>
  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name35}</th>
   <th style={{backgroundColor:'white'}}>{this.varvalue35(data)}</th>
 </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{beforediscount}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{afterdiscount}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </th>
    <th style={{backgroundColor:'white'}}>{allpartnerpaid}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User) *</th>
    <th style={{backgroundColor:'white'}}>{alluserpaid}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company) *</th>
    <th style={{backgroundColor:'white'}}>{allcompanypaid}</th>
  </tr>
  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>เอกสารชำระเงิน กรมธรรม์</th>
  {this.insurancepaymentcopy(data)}
 </tr>
 <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
<th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>เอกสารชำระเงินไปยังบริษัทประกัน</th>
 {this.insurancepaymenttocompanycopy(data)}
</tr>
    </thead>

    </table>
    </div>
    <div class="column4">
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th colSpan="2" style={{backgroundColor:'white',width:'200px',height:'',textAlign:'center',fontSize:'20px'}}>ข้อมูลพรบ.</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>&nbsp;</th>
   <th style={{backgroundColor:'white'}}>&nbsp;</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name27}</th>
     <th style={{backgroundColor:'white'}}>{data.var_value27}</th>
   </tr>

    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name30}</th>
     <th style={{backgroundColor:'white'}}>{data.var_value30}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>บริษััทประกันที่เลือก(ใหม่)พรบ</th>
     <th style={{backgroundColor:'white'}}>{confirmofferact} </th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>เบี้ยรวมหน้าตั๋ว</th>
     <th style={{backgroundColor:'white'}}>{confirmofferpayment4act}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</th>
     <th style={{backgroundColor:'white'}}>{confirmofferpayment5act}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ส่วนลดพิเศษทั้งหมด </th>
     <th style={{backgroundColor:'white'}}>{alldiscountact}</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name33}</th>
    <th style={{backgroundColor:'white'}}>{data.var_value33}</th>
  </tr>
  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name36}</th>
   <th style={{backgroundColor:'white'}}>{this.varvalue36(data)}</th>
 </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{beforediscountact}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{afterdiscountact}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </th>
    <th style={{backgroundColor:'white'}}>{allpartnerpaidact}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User) *</th>
    <th style={{backgroundColor:'white'}}>{alluserpaidact}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company) *</th>
    <th style={{backgroundColor:'white'}}>{allcompanypaidact}</th>
  </tr>
  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>เอกสารชำระเงิน พรบ.</th>
  {this.copypaymentact(data)}
 </tr>
 <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
<th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>เอกสารชำระเงินไปยังบริษัทประกัน</th>
 {this.actpaymenttocompanycopy(data)}
</tr>
    </thead>

    </table>
    </div>
    <div class="column4">
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th colSpan="2" style={{backgroundColor:'white',width:'200px',height:'',textAlign:'center',fontSize:'20px'}}>ข้อมูลภาษี</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>&nbsp;</th>
   <th style={{backgroundColor:'white'}}>&nbsp;</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>&nbsp;</th>
   <th style={{backgroundColor:'white'}}>&nbsp;</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name31}</th>
     <th style={{backgroundColor:'white'}}>{data.var_value31}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>บริษััทประกันที่เลือก(ใหม่)ภาษี</th>
     <th style={{backgroundColor:'white'}}>{confirmoffertax} </th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>เบี้ยรวมหน้าตั๋ว</th>
     <th style={{backgroundColor:'white'}}>{confirmofferpayment4tax}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</th>
     <th style={{backgroundColor:'white'}}>{confirmofferpayment5tax}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ส่วนลดพิเศษทั้งหมด </th>
     <th style={{backgroundColor:'white'}}>{alldiscounttax}</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name34}</th>
    <th style={{backgroundColor:'white'}}>{data.var_value34}</th>
  </tr>


  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{data.case_type.var_name37}</th>
   <th style={{backgroundColor:'white'}}>{this.varvalue37(data)}</th>
 </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{beforediscounttax}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{afterdiscounttax}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </th>
    <th style={{backgroundColor:'white'}}>{allpartnerpaidtax}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User) *</th>
    <th style={{backgroundColor:'white'}}>{alluserpaidtax}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company) *</th>
    <th style={{backgroundColor:'white'}}>{allcompanypaidtax}</th>
  </tr>
  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>เอกสารชำระเงิน ภาษี</th>
  {this.taxpaymentcopy(data)}
 </tr>
 <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
<th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>เอกสารชำระเงินไปยังบริษัทประกัน</th>
 {this.taxpaymenttocompanycopy(data)}
</tr>
    </thead>

    </table>
    </div>
    <div class="column4">
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th colSpan="2" style={{backgroundColor:'#72EB00',width:'200px',height:'',textAlign:'center',fontSize:'20px'}}>รวม</th>
    </tr>
    <tr style={{border:'0.5px solid #F4F4F6',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>&nbsp;</th>
    <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
    <tr style={{border:'0.5px solid #F4F4F6',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>&nbsp;</th>
    <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
    <tr style={{border:'0.5px solid #F4F4F6',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>&nbsp;</th>
    <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
    <tr style={{border:'0.5px solid #F4F4F6',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>&nbsp;</th>
    <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'200px',height:'60px'}}>เบี้ยรวมหน้าตั๋ว(รวม)</th>
     <th style={{backgroundColor:'#72EB00'}}>{allcalinsurance}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'200px',height:'60px'}}>ยอดหัก ณ ที่จ่าย * (รวม)</th>
     <th style={{backgroundColor:'#72EB00'}}>{allofferpayment5}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'200px',height:'60px'}}>ส่วนลดพิเศษทั้งหมด (รวม) </th>
     <th style={{backgroundColor:'#72EB00'}}>{alldiscountcal}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>&nbsp;</th>
    <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>&nbsp;</th>
    <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย (Customer)</th>
    <th style={{backgroundColor:'#72EB00'}}>{beforediscountall}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย (Customer)</th>
    <th style={{backgroundColor:'#72EB00'}}>{afterdiscountall}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </th>
    <th style={{backgroundColor:'#72EB00'}}>{allpartnerpaidcal}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User) *</th>
    <th style={{backgroundColor:'#72EB00'}}>{alluserpaidcal}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'200px',height:'60px'}}>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company) *</th>
    <th style={{backgroundColor:'#72EB00'}}>{allcompanypaidcal}</th>
    </tr>

    </thead>

    </table>
    </div>
    </div>
    </div>
    </div>
  }
}
  casetracking(data)
  {
    if(this.state.casetrackingcolumn == 0)
    {
    return <div class="column22" id="casetracking">
    <div class={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
    <div class="box-header  ">
      <b class="box-title" >สถานะงาน (Case Tracking)</b>
      <br/>
      <br/>
       <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
       <thead>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>สถานะงาน</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{data.case_status.name}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ขั้นตอนงาน</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.stagename(data)}</th>
      </tr>
      <tr role="row" >
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่งานเสร็จสิ้น</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{data.finish_date}</th>
     </tr>
     <tr role="row" >
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ต่ออายุอัตโนมัติ</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{data.auto_renew_date}</th>
    </tr>
     </thead>
       </table>
      <div class="box-tools pull-right">
        <button type="button" onClick={this.columnchangecasetracking} class="btn btn-box-tool" ><i class="fa fa-plus"></i></button>
      </div>
    </div>
    </div>
    </div>

  }
  else{
    return <div>{this.fixcasetracking(data)}</div>
  }
  }
  varvalue35(data)
  {
    if(this.state.filcase.var_value35 == 0)
    {
      return <span>ตัด Net</span>
    }
    else if(this.state.filcase.var_value35 == 1)
    {
      return <span> รับคอมมิชชั่นทีหลัง</span>
    }
  }
  varvalue36(data)
  {
    if(this.state.filcase.var_value36 == 0)
    {
      return <span>ตัด Net</span>
    }
    else if(this.state.filcase.var_value36 == 1)
    {
      return <span> รับคอมมิชชั่นทีหลัง</span>
    }
  }
  varvalue37(data)
  {
    if(this.state.filcase.var_value37 == 0)
    {
      return <span>ตัด Net</span>
    }
    else if(this.state.filcase.var_value37 == 1)
    {
      return <span> รับคอมมิชชั่นทีหลัง</span>
    }
  }
  loadmemberfile(data)
  {
    this.state.citizenfile  = this.state.memberfile.filter((memberfile) => {
     return memberfile.file_cat_id == 9
   })
   this.state.driverfile  = this.state.memberfile.filter((memberfile) => {
    return memberfile.file_cat_id == 11
  })
  this.state.employeefile  = this.state.memberfile.filter((memberfile) => {
   return memberfile.file_cat_id == 31
  })
  this.state.salaryslipfile  = this.state.memberfile.filter((memberfile) => {
   return memberfile.file_cat_id == 32
  })
  this.state.carfile  = this.state.memberfile.filter((memberfile) => {
   return memberfile.file_cat_id == 15
  })
  this.state.oldinsurances  = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 36
  })
  this.state.oldact  = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 37
  })
  this.state.oldtax  = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 38
  })
  this.state.guaranteereceipt  = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 39
  })
  this.state.discountcoupon   = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 40
  })
  this.state.insuranceapplication  = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 41
  })
  this.state.guaranteereceipt  = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 42
  })
  this.state.copyrenewalnotice  = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 43
  })
  this.state.carcamera  = this.state.assetfile.filter((assetfile) => {
   return assetfile.file_cat_id == 44
  })
  this.state.copyact   = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 45
  })
  this.state.insurancecopy   = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 46
  })
  this.state.taxcopy   = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 47
  })
  this.state.insurancecopypayment   = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 50
  })
  this.state.insurancepaymenttocompanycopy   = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 54
  })
  this.state.actpaymenttocompanycopy   = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 55
  })
  this.state.taxpaymenttocompanycopy   = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 56
  })
  this.state.actcopypayment   = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 51
  })
  this.state.taxcopypayment   = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 52
  })
  this.state.anotherfile  = this.state.casefile.filter((casefile) => {
   return casefile.file_cat_id == 53
  })
  this.state.carphoto  = this.state.assetfile.filter((assetfile) => {
   return assetfile.file_cat_id == 14
  })

   //console.log(this.state.citizenfile);
  }
  citizenfile(data)
  {
    if(this.state.citizenfile.length > 0)
    {
      return  <th style={{backgroundColor:'#72EB00'}}>&nbsp;{this.state.citizenfile.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let memberid = data.member_case_owner;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/member/uploadfile/"+memberid+"/xxx/CG3CG/Member_Attachment_"+memberid+"?cat?CA9CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }


  driverfile(data)
  {
    if(this.state.driverfile.length > 0)
    {
      return <th style={{backgroundColor:'#72EB00'}}>&nbsp;{this.state.driverfile.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>

    }
    else
    {
      let memberid = data.member_case_owner;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/member/uploadfile/"+memberid+"/xxx/CG3CG/Member_Attachment_"+memberid+"?cat?CA11CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>

    }
  }
  employeefile(data)
  {
    if(this.state.employeefile.length > 0)
    {
      return <th style={{backgroundColor:'#72EB00'}}>&nbsp;{this.state.employeefile.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let memberid = data.member_case_owner;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/member/uploadfile/"+memberid+"/xxx/CG3CG/Member_Attachment_"+memberid+"?cat?CA31CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  salaryslipfile(data)
  {
    if(this.state.salaryslipfile.length > 0)
    {
      return   <th style={{backgroundColor:'#72EB00'}}>&nbsp;{this.state.salaryslipfile.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let memberid = data.member_case_owner;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/member/uploadfile/"+memberid+"/xxx/CG3CG/Member_Attachment_"+memberid+"?cat?CA32CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>  }
  }
  carfile(data)
  {
    if(this.state.carfile.length > 0)
    {
      return <th style={{backgroundColor:'#72EB00'}}>&nbsp;{this.state.carfile.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let assetid = data.referal_asset;
      let portid =data.asset.port_id;


      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/asset/uploadfile/"+portid+"/"+assetid+"/xxx/CG2CG/Asset_Attachment_"+portid+"_"+assetid+"?cat?CA15CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
    }

  oldinsurances(data)
  {
    if(this.state.oldinsurances.length > 0)
    {
      return  <th style={{backgroundColor:'#72EB00'}}>&nbsp;{this.state.oldinsurances.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>

    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA36CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  oldact(data)
  {
    if(this.state.oldact.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.oldact.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA37CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
      }
  }
  oldtax(data)
  {
    if(this.state.oldtax.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.oldtax.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>

    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA38CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  discountcoupon(data)
  {
    if(this.state.discountcoupon.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.discountcoupon.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA39CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  insuranceapplication(data)
  {
    if(this.state.insuranceapplication.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.insuranceapplication.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA40CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  copyrenewalnotice(data)
  {
    if(this.state.copyrenewalnotice.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.copyrenewalnotice.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA41CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  vehicleinspection(data)
  {
    if(this.state.vehicleinspection.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.vehicleinspection.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA42CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  guaranteereceipt(data)
  {
    if(this.state.guaranteereceipt.length > 0)
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;{this.state.guaranteereceipt.map(data => <a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a>)}</th>
    }
    else
    {
      let caseid = data.id;
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+caseid+"/xxx/CG4CG/Case_Attachment?cat?CA43CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
    }
  }
  showbranchname(data)
  {
    if(data.ref_branch_id == 0 ||data.ref_branch_id == '' ||data.ref_branch_id == null)
    {
      return <th></th>
    }
    else
    {
      return <th>{data.branch.name}</th>
    }
  }
  showcaselog(data)
  {
    if(this.state.caselog.length >= 1)
    {
      return
      <div>{this.state.caselog.map(data =>

      <tr>
      <td>{data.date_time}</td>
      <td>{data.movefromstage.name}</td>
      <td style={{textAlign:'center',fontSize:'22px',color:'green'}}><i class="fa fa-long-arrow-right"></i></td>
      <td>{data.movetostage.name}</td>
      <td><a onClick={this.onClickcasecondition.bind(this, data)} class="btn btn-info btn-margin">รายละเอียด</a></td>
      </tr>

    )}
    </div>
    }
    else
    {
      return       <tr>
            <td></td>
            <td></td>
            <td style={{textAlign:'center',fontSize:'22px',color:'green'}}><i class="fa fa-long-arrow-right"></i></td>
            <td></td>
            <td></td>
            </tr>

    }
  }
  showcaseaction()
  {
    if(this.state.caseaction.length >= 1)
    {
      return
      <div>{this.state.caseaction.map(data =>

        <tr>
        <td>{data.stage.name}</td>
        <td>{data.stageaction.name}</td>
        <td>{data.time}</td>

        </tr>

    )}
    </div>
    }
    else
    {
      return      <tr>
      <td></td>
      <td></td>
      <td></td>

      </tr>

    }
  }
  showcasecondition()
  {
    if(this.state.showcaseconditionflag == 1)
    {
      return <div class="box" style={{backgroundColor:'white'}}>
      <div class="box-header  ">
        <b class="box-title" data-widget="collapse">เงื่อนไขที่ผ่าน</b>
        <div class="box-tools pull-right">
          <button type="button" onClick={this.closcasecondition} class="btn btn-box-tool"><i style={{color:'red'}}class="fa fa-close"></i></button>
        </div>
       </div>
        <div class="box-body" >

            {this.state.caseconditionarray.map(data =>

            <p style={{fontSize:'16px',borderBottom:'solid 2px silver'}}>
            {data.date_time}&nbsp;&nbsp; {data.path_condition_detail.name} &nbsp;&nbsp;<i style={{color:'green'}}class="fa fa-check-square"></i>
            </p>
          )}

        </div>
        </div>
    }
    else
    {
    }

  }
  recheckofferbutton(data)
  {
    if(data.var_value129 == 1 )
    {
      return <a style={{color:'orange'}}>กำลังทบทวนเบี้ย</a>
    }
    else
    {
      return <a  onClick={this.recheckoffer}  style={{color:'orange'}}>ทบทวนเบี้ย</a>
    }
  }
  showdetail()
  {
    let confirmofferinsurancename = '';
    let confirmofferpayment4 = '';
    let confirmofferpayment5 = '';
    let confirmofferpayment15 = '';
    let confirmofferpayment16 = '';
    let confirmofferpayment18 = '';
    let confirmofferpayment20 = '';
    let confirmofferpayment17 = '';
    let confirmofferpayment19 = '';
    let confirmofferpayment8 = '';
    let alldiscount = '';
    let alldiscountact = '';
    let alldiscounttax = '';
    let beforediscount = '';
    let beforediscountact = '';
    let beforediscounttax = '';
    let afterdiscount = '';
    let afterdiscountact = '';
    let afterdiscounttax = '';
    let allpartnerpaid = '';
    let allpartnerpaidact = '';
    let allpartnerpaidtax = '';
    let alluserpaid = '';
    let alluserpaidact = '';
    let alluserpaidtax = '';
    let allcompanypaid = '';
    let allcompanypaidact = '';
    let allcompanypaidtax = '';

    let confirmofferinsuranceproposal = '';
    let confirmofferact = '';
    let confirmofferactproposal = '';
    let confirmoffertax = '';
    let confirmoffertaxproposal = '';
    let confirmofferpayment4act = '';
    let confirmofferpayment5act = '';
    let confirmofferpayment15act = '';
    let confirmofferpayment16act = '';
    let confirmofferpayment18act = '';
    let confirmofferpayment20act = '';
    let confirmofferpayment17act = '';
    let confirmofferpayment19act = '';
    let confirmofferpayment8act = '';
    let confirmofferpayment4tax = '';
    let confirmofferpayment5tax = '';
    let confirmofferpayment15tax = '';
    let confirmofferpayment16tax = '';
    let confirmofferpayment18tax = '';
    let confirmofferpayment20tax = '';
    let confirmofferpayment17tax = '';
    let confirmofferpayment19tax = '';
    let confirmofferpayment8tax = '';

    if(this.state.confirmoffer.length >=1)
    {
      let findconfirmofferinsurance1 = this.state.confirmoffer.find((confirmoffer) => {
       return confirmoffer.type_id == 1
     })


     let findconfirmofferinsurance1plus = this.state.confirmoffer.find((confirmoffer) => {
      return confirmoffer.type_id == 2
    })


    let findconfirmofferinsurance2plus = this.state.confirmoffer.find((confirmoffer) => {
     return confirmoffer.type_id == 3
    })


    let findconfirmofferinsurance3plus = this.state.confirmoffer.find((confirmoffer) => {
    return confirmoffer.type_id == 4
    })

    let findconfirmofferinsurance3 = this.state.confirmoffer.find((confirmoffer) => {
    return confirmoffer.type_id == 5
    })



    let findconfirmofferinsurance2 = this.state.confirmoffer.find((confirmoffer) => {
    return confirmoffer.type_id == 6
    })


    let findconfirmofferact = this.state.confirmoffer.find((confirmoffer) => {
      return confirmoffer.type_id == 7
    })


    let findconfirmoffertax = this.state.confirmoffer.find((confirmoffer) => {
     return confirmoffer.type_id == 8
    })
    console.log("offer_type1"+findconfirmofferinsurance1)
    console.log("offer_type1+"+findconfirmofferinsurance1plus)
    console.log("offer_type2+"+findconfirmofferinsurance2plus)
    console.log("offer_type3+"+findconfirmofferinsurance3plus)
    console.log("offer_type3"+findconfirmofferinsurance3)
    console.log("offer_type2"+findconfirmofferinsurance2)
    console.log("offer_typeact"+findconfirmofferact)
    console.log("offer_typetax"+findconfirmoffertax)

       if(findconfirmofferinsurance1 != undefined)
       {
         let findconfirmofferinsurance1proposal = this.state.proposal.find((proposal) => {
          return proposal.id == findconfirmofferinsurance1.proposal.id
        })
         confirmofferinsurancename = findconfirmofferinsurance1.person.name;
         confirmofferpayment4 = findconfirmofferinsurance1.offer_payment_value4;
         confirmofferpayment5 = findconfirmofferinsurance1.offer_payment_value5;
         confirmofferpayment15  = findconfirmofferinsurance1.offer_payment_value15;
         confirmofferpayment16 = findconfirmofferinsurance1.offer_payment_value16;
         confirmofferpayment18  = findconfirmofferinsurance1.offer_payment_value18;
         confirmofferpayment20  = findconfirmofferinsurance1.offer_payment_value20;
         confirmofferpayment17  = findconfirmofferinsurance1.offer_payment_value17;
         confirmofferpayment19 = findconfirmofferinsurance1.offer_payment_value19;
         confirmofferpayment8 = findconfirmofferinsurance1.offer_payment_value8;
         let caldiscount = Number(confirmofferpayment15)+Number(confirmofferpayment16)+Number(confirmofferpayment18)+Number(confirmofferpayment20);
         alldiscount = caldiscount.toFixed(2);
         let calbefore = Number(confirmofferpayment4)-Number(alldiscount);
         beforediscount = calbefore.toFixed(2);
         let calafter = Number(beforediscount) - Number(confirmofferpayment5);
         afterdiscount = calafter.toFixed(2);
         let calallpartnerpaid = Number(afterdiscount)+Number(confirmofferpayment17);
         allpartnerpaid = calallpartnerpaid.toFixed(2);
         let calalluserpaid = Number(afterdiscount)+Number(confirmofferpayment19);
         alluserpaid = calalluserpaid.toFixed(2);
         let calallcompanypaid = Number(confirmofferpayment4)-Number(confirmofferpayment8)-Number(confirmofferpayment5);
         allcompanypaid = calallcompanypaid.toFixed(2);
         confirmofferinsuranceproposal = findconfirmofferinsurance1proposal.partner_block.name;
       }

       else if(findconfirmofferinsurance1plus != undefined)
       {
         let findconfirmofferinsurance1plusproposal = this.state.proposal.find((proposal) => {
          return proposal.id == findconfirmofferinsurance1plus.proposal.id
        })
         confirmofferinsurancename = findconfirmofferinsurance1plus.person.name;
         confirmofferpayment4 = findconfirmofferinsurance1plus.offer_payment_value4;
         confirmofferpayment5 = findconfirmofferinsurance1plus.offer_payment_value5;

         confirmofferpayment15  = findconfirmofferinsurance1plus.offer_payment_value15;
         confirmofferpayment16 = findconfirmofferinsurance1plus.offer_payment_value16;
         confirmofferpayment18  = findconfirmofferinsurance1plus.offer_payment_value18;
         confirmofferpayment20  = findconfirmofferinsurance1plus.offer_payment_value20;
         confirmofferpayment17  = findconfirmofferinsurance1plus.offer_payment_value17;
         confirmofferpayment19 = findconfirmofferinsurance1plus.offer_payment_value19;
         confirmofferpayment8 = findconfirmofferinsurance1plus.offer_payment_value8;
         let caldiscount = Number(confirmofferpayment15)+Number(confirmofferpayment16)+Number(confirmofferpayment18)+Number(confirmofferpayment20);
         alldiscount = caldiscount.toFixed(2);
         let calbefore = Number(confirmofferpayment4)-Number(alldiscount);
         beforediscount = calbefore.toFixed(2);
         let calafter = Number(beforediscount) - Number(confirmofferpayment5);
         afterdiscount = calafter.toFixed(2);
         let calallpartnerpaid = Number(afterdiscount)+Number(confirmofferpayment17);
         allpartnerpaid = calallpartnerpaid.toFixed(2);
         let calalluserpaid = Number(afterdiscount)+Number(confirmofferpayment19);
         alluserpaid = calalluserpaid.toFixed(2);
         let calallcompanypaid = Number(confirmofferpayment4)-Number(confirmofferpayment8)-Number(confirmofferpayment5);
         allcompanypaid = calallcompanypaid.toFixed(2);
         confirmofferinsuranceproposal = findconfirmofferinsurance1plusproposal.partner_block.name;

       }
       else if(findconfirmofferinsurance2plus != undefined)
       {
         let findconfirmofferinsurance2plusproposal = this.state.proposal.find((proposal) => {
          return proposal.id == findconfirmofferinsurance2plus.proposal.id
         })
         confirmofferinsurancename = findconfirmofferinsurance2plus.person.name;
         confirmofferpayment4 = findconfirmofferinsurance2plus.offer_payment_value4;
         confirmofferpayment5 = findconfirmofferinsurance2plus.offer_payment_value5;
         confirmofferpayment15  = findconfirmofferinsurance2plus.offer_payment_value15;
         confirmofferpayment16 = findconfirmofferinsurance2plus.offer_payment_value16;
         confirmofferpayment18  = findconfirmofferinsurance2plus.offer_payment_value18;
         confirmofferpayment20  = findconfirmofferinsurance2plus.offer_payment_value20;
         confirmofferpayment17  = findconfirmofferinsurance2plus.offer_payment_value17;
         confirmofferpayment19 = findconfirmofferinsurance2plus.offer_payment_value19;
         confirmofferpayment8 = findconfirmofferinsurance2plus.offer_payment_value8;
         let caldiscount = Number(confirmofferpayment15)+Number(confirmofferpayment16)+Number(confirmofferpayment18)+Number(confirmofferpayment20);
         alldiscount = caldiscount.toFixed(2);
         let calbefore = Number(confirmofferpayment4)-Number(alldiscount);
         beforediscount = calbefore.toFixed(2);
         let calafter = Number(beforediscount) - Number(confirmofferpayment5);
         afterdiscount = calafter.toFixed(2);
         let calallpartnerpaid = Number(afterdiscount)+Number(confirmofferpayment17);
         allpartnerpaid = calallpartnerpaid.toFixed(2);
         let calalluserpaid = Number(afterdiscount)+Number(confirmofferpayment19);
         alluserpaid = calalluserpaid.toFixed(2);
         let calallcompanypaid = Number(confirmofferpayment4)-Number(confirmofferpayment8)-Number(confirmofferpayment5);
         allcompanypaid = calallcompanypaid.toFixed(2);
         confirmofferinsuranceproposal = findconfirmofferinsurance2plusproposal.partner_block.name;
       }
       else if(findconfirmofferinsurance3plus != undefined)
       {
         let findconfirmofferinsurance3pluspropsal = this.state.proposal.find((proposal) => {
          return proposal.id == findconfirmofferinsurance3plus.proposal.id
         })

         confirmofferinsurancename = findconfirmofferinsurance3plus.person.name;
         confirmofferpayment4 = findconfirmofferinsurance3plus.offer_payment_value4;
         confirmofferpayment5 = findconfirmofferinsurance3plus.offer_payment_value5;
         confirmofferpayment15  = findconfirmofferinsurance3plus.offer_payment_value15;
         confirmofferpayment16 = findconfirmofferinsurance3plus.offer_payment_value16;
         confirmofferpayment18  = findconfirmofferinsurance3plus.offer_payment_value18;
         confirmofferpayment20  = findconfirmofferinsurance3plus.offer_payment_value20;
         confirmofferpayment17  = findconfirmofferinsurance3plus.offer_payment_value17;
         confirmofferpayment19 = findconfirmofferinsurance3plus.offer_payment_value19;
         confirmofferpayment8 = findconfirmofferinsurance3plus.offer_payment_value8;
         let caldiscount = Number(confirmofferpayment15)+Number(confirmofferpayment16)+Number(confirmofferpayment18)+Number(confirmofferpayment20);
         alldiscount = caldiscount.toFixed(2);
         let calbefore = Number(confirmofferpayment4)-Number(alldiscount);
         beforediscount = calbefore.toFixed(2);
         let calafter = Number(beforediscount) - Number(confirmofferpayment5);
         afterdiscount = calafter.toFixed(2);
         let calallpartnerpaid = Number(afterdiscount)+Number(confirmofferpayment17);
         allpartnerpaid = calallpartnerpaid.toFixed(2);
         let calalluserpaid = Number(afterdiscount)+Number(confirmofferpayment19);
         alluserpaid = calalluserpaid.toFixed(2);
         let calallcompanypaid = Number(confirmofferpayment4)-Number(confirmofferpayment8)-Number(confirmofferpayment5);
         allcompanypaid = calallcompanypaid.toFixed(2);
         confirmofferinsuranceproposal = findconfirmofferinsurance3pluspropsal.partner_block.name;
       }
       else if(findconfirmofferinsurance3 != undefined)
       {
         let findconfirmofferinsurance3proposal = this.state.proposal.find((proposal) => {
          return proposal.id == findconfirmofferinsurance3.proposal.id
         })
         confirmofferinsurancename = findconfirmofferinsurance3.person.name;
         confirmofferpayment4 = findconfirmofferinsurance3.offer_payment_value4;
         confirmofferpayment5 = findconfirmofferinsurance3.offer_payment_value5;
         confirmofferpayment15  = findconfirmofferinsurance3.offer_payment_value15;
         confirmofferpayment16 = findconfirmofferinsurance3.offer_payment_value16;
         confirmofferpayment18  = findconfirmofferinsurance3.offer_payment_value18;
         confirmofferpayment20  = findconfirmofferinsurance3.offer_payment_value20;
         confirmofferpayment17  = findconfirmofferinsurance3.offer_payment_value17;
         confirmofferpayment19 = findconfirmofferinsurance3.offer_payment_value19;
         confirmofferpayment8 = findconfirmofferinsurance3.offer_payment_value8;
         let caldiscount = Number(confirmofferpayment15)+Number(confirmofferpayment16)+Number(confirmofferpayment18)+Number(confirmofferpayment20);
         alldiscount = caldiscount.toFixed(2);
         let calbefore = Number(confirmofferpayment4)-Number(alldiscount);
         beforediscount = calbefore.toFixed(2);
         let calafter = Number(beforediscount) - Number(confirmofferpayment5);
         afterdiscount = calafter.toFixed(2);
         let calallpartnerpaid = Number(afterdiscount)+Number(confirmofferpayment17);
         allpartnerpaid = calallpartnerpaid.toFixed(2);
         let calalluserpaid = Number(afterdiscount)+Number(confirmofferpayment19);
         alluserpaid = calalluserpaid.toFixed(2);
         let calallcompanypaid = Number(confirmofferpayment4)-Number(confirmofferpayment8)-Number(confirmofferpayment5);
         allcompanypaid = calallcompanypaid.toFixed(2);
         confirmofferinsuranceproposal = findconfirmofferinsurance3proposal.partner_block.name;
       }
       else if(findconfirmofferinsurance2 != undefined)
       {
         let findconfirmofferinsurance2proposal = this.state.proposal.find((proposal) => {
          return proposal.id == findconfirmofferinsurance2.proposal.id
         })
         confirmofferinsurancename = findconfirmofferinsurance2.person.name;
         confirmofferpayment4 = findconfirmofferinsurance2.offer_payment_value4;
         confirmofferpayment5 = findconfirmofferinsurance2.offer_payment_value5;
         confirmofferpayment15  = findconfirmofferinsurance2.offer_payment_value15;
         confirmofferpayment16 = findconfirmofferinsurance2.offer_payment_value16;
         confirmofferpayment18  = findconfirmofferinsurance2.offer_payment_value18;
         confirmofferpayment20  = findconfirmofferinsurance2.offer_payment_value20;
         confirmofferpayment17  = findconfirmofferinsurance2.offer_payment_value17;
         confirmofferpayment19 = findconfirmofferinsurance2.offer_payment_value19;
         confirmofferpayment8 = findconfirmofferinsurance2.offer_payment_value8;
         let caldiscount = Number(confirmofferpayment15)+Number(confirmofferpayment16)+Number(confirmofferpayment18)+Number(confirmofferpayment20);
         alldiscount = caldiscount.toFixed(2);
         let calbefore = Number(confirmofferpayment4)-Number(alldiscount);
         beforediscount = calbefore.toFixed(2);
         let calafter = Number(beforediscount) - Number(confirmofferpayment5);
         afterdiscount = calafter.toFixed(2);
         let calallpartnerpaid = Number(afterdiscount)+Number(confirmofferpayment17);
         allpartnerpaid = calallpartnerpaid.toFixed(2);
         let calalluserpaid = Number(afterdiscount)+Number(confirmofferpayment19);
         alluserpaid = calalluserpaid.toFixed(2);
         let calallcompanypaid = Number(confirmofferpayment4)-Number(confirmofferpayment8)-Number(confirmofferpayment5);
         allcompanypaid = calallcompanypaid.toFixed(2);
         confirmofferinsuranceproposal = findconfirmofferinsurance2propsal.partner_block.name;
       }
       else
       {
         confirmofferinsurancename = '';
         confirmofferinsuranceproposal = '';
         confirmofferpayment4 = '';
         confirmofferpayment5 = '';
         confirmofferpayment15 = '';
         confirmofferpayment16 = '';
         confirmofferpayment18 = '';
         confirmofferpayment20 = '';
         confirmofferpayment17 = '';
         confirmofferpayment19 = '';
         confirmofferpayment8 = '';
       }
       if(findconfirmofferact != undefined)
      {
        let findconfirmofferactproposal = this.state.proposal.find((proposal) => {
         return proposal.id == findconfirmofferact.proposal.id
        })
        confirmofferact = findconfirmofferact.person.name;
        confirmofferpayment4act = findconfirmofferact.offer_payment_value4;
        confirmofferpayment5act = findconfirmofferact.offer_payment_value5;
        confirmofferpayment15act  = findconfirmofferact.offer_payment_value15;
        confirmofferpayment16act = findconfirmofferact.offer_payment_value16;
        confirmofferpayment18act  = findconfirmofferact.offer_payment_value18;
        confirmofferpayment20act  = findconfirmofferact.offer_payment_value20;
        confirmofferpayment17act  = findconfirmofferact.offer_payment_value17;
        confirmofferpayment19act = findconfirmofferact.offer_payment_value19;
        confirmofferpayment8act = findconfirmofferact.offer_payment_value8;
        let caldiscountact = Number(confirmofferpayment15act)+Number(confirmofferpayment16act)+Number(confirmofferpayment18act)+Number(confirmofferpayment20act);
        alldiscountact = caldiscountact.toFixed(2);
        let calbeforeact = Number(confirmofferpayment4act)-Number(alldiscountact);
        beforediscountact = calbeforeact.toFixed(2);
        let calafteract = Number(beforediscountact) - Number(confirmofferpayment5act);
        afterdiscountact = calafteract.toFixed(2);
        let calallpartnerpaidact = Number(afterdiscountact)+Number(confirmofferpayment17act);
        allpartnerpaidact = calallpartnerpaidact.toFixed(2);
        let calalluserpaidact = Number(afterdiscountact)+Number(confirmofferpayment19act);
        alluserpaidact = calalluserpaidact.toFixed(2);
        let calallcompanypaidact = Number(confirmofferpayment4act)-Number(confirmofferpayment8act)-Number(confirmofferpayment5act);
        allcompanypaidact = calallcompanypaidact.toFixed(2);
        confirmofferactproposal = findconfirmofferactproposal.partner_block.name;
      }
      else
      {
        confirmofferact = 'งานนี้ไม่ไดเลือก พรบ';
        confirmofferactproposal = '';
        confirmofferpayment4act = '';
        confirmofferpayment5act = '';
        confirmofferpayment15act  = '';
        confirmofferpayment16act = '';
        confirmofferpayment18act = '';
        confirmofferpayment20act  = '';
        confirmofferpayment17act  = '';
        confirmofferpayment19act = '';
        confirmofferpayment8act = '';
      }
      if(findconfirmoffertax != undefined)
      {
        let findconfirmoffertaxproposal = this.state.proposal.find((proposal) => {
         return proposal.id == findconfirmoffertax.proposal.id
        })
         confirmoffertax = findconfirmoffertax.person.name;
         confirmofferpayment4tax = findconfirmoffertax.offer_payment_value4;
         confirmofferpayment5tax = findconfirmoffertax.offer_payment_value5;
         confirmofferpayment15tax  = findconfirmoffertax.offer_payment_value15;
         confirmofferpayment16tax = findconfirmoffertax.offer_payment_value16;
         confirmofferpayment18tax  = findconfirmoffertax.offer_payment_value18;
         confirmofferpayment20tax  = findconfirmoffertax.offer_payment_value20;
         confirmofferpayment17tax  = findconfirmoffertax.offer_payment_value17;
         confirmofferpayment19tax = findconfirmoffertax.offer_payment_value19;
         confirmofferpayment8tax= findconfirmoffertax.offer_payment_value8;
         let caldiscounttax = Number(confirmofferpayment15tax)+Number(confirmofferpayment16tax)+Number(confirmofferpayment18tax)+Number(confirmofferpayment20tax);
         alldiscounttax = caldiscounttax.toFixed(2);
         let calbeforetax = Number(confirmofferpayment4act)-Number(alldiscounttax);
         beforediscounttax = calbeforetax.toFixed(2);
         let calaftertax = Number(beforediscounttax) - Number(confirmofferpayment5tax);
         afterdiscounttax= calaftertax.toFixed(2);
         let calallpartnerpaidtax = Number(afterdiscounttax)+Number(confirmofferpayment17tax);
         allpartnerpaidtax = calallpartnerpaidtax.toFixed(2);
         let calalluserpaidtax = Number(afterdiscounttax)+Number(confirmofferpayment19tax);
         alluserpaidtax = calalluserpaidtax.toFixed(2);
         let calallcompanypaidtax = Number(confirmofferpayment4tax)-Number(confirmofferpayment8tax)-Number(confirmofferpayment5tax);
         allcompanypaidtax = calallcompanypaidtax.toFixed(2);
         confirmoffertaxproposal = findconfirmoffertaxproposal.partner_block.name;
      }
      else
      {
        confirmoffertax = 'งานนี้ไม่ไดเลือก ภาษี';
        confirmoffertaxproposal = '';
        confirmofferpayment4tax = '';
        confirmofferpayment5tax = '';
        confirmofferpayment15tax  = '';
        confirmofferpayment16tax = '';
        confirmofferpayment18tax  = '';
        confirmofferpayment20tax  = '';
        confirmofferpayment17tax = '';
        confirmofferpayment19tax = '';
        confirmofferpayment8tax= '';
      }

    }
    else
    {
      confirmofferinsurancename = '';
      confirmofferinsuranceproposal = '';
    }
      return <div> {this.state.filcase.map(data =><div class="card"><div class="card-header ">
      <a style={{float:'right',fontSize:'25px',color:'red',padding:'10px'}} href="/wealththaiinsurance/all/cases" ><i class="fa fa-close"></i></a>
      <a style={{float:'right',fontSize:'25px',color:'orange',padding:'10px'}} href={'/wealththaiinsurance/cases/edit/'+data.id} ><i class="fa fa-gear"></i></a>
      {this.notebutton(data)}
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      {this.cancelbutton(data)}
      {this.renewbutton(data)}
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      {this.invoicebutton(data)}

  <Modal visible={this.state.visible} width="600" height="600" effect="fadeInUp" onClickAway={() => this.closeModal()}>
      <div class="card ">
      <div class="card-header  ">
      <a style={{float:'right',color:'red',fontSize:'18px'}} href="javascript:void(0);" onClick={() => this.closeModal()}><i class="fa fa-close"></i></a>
          <h3>การจดบันทึก</h3>
          </div>
          <div class="card-body">
          <div class="column2fordis">
          <p><b>การจดบันทึกจากงานที่แล้ว</b></p>
          {this.noteprevcase(data)}
          </div>
          <div class="column2fordis">
          <p><b>การจดบันทึกไปยังงานใหม่</b></p>
          {this.notenextcase(data)}
          </div>
          <p>&nbsp;</p>

          <div class="column2fordis">
          <p><b>การจดบันทึกจากลูกค้า</b></p>
          {this.notefrommember(data)}
          </div>
          <div class="column2fordis">
          <p><b>การจดบันทึกจากผู้ให้คำปรึกษา</b></p>
          {this.notefrompartner(data)}
          </div>
          <p>&nbsp;</p>

          <div class="column2fordis">
          <p><b>การจดบันทึกจากผู้แจ้งงาน</b></p>
          {this.notefromuser(data)}
          </div>

          </div>

      </div>
  </Modal>
  <p>&nbsp;</p>
  <p>&nbsp;</p>

     <h4 style={{textAlign:'center'}}>{this.props.id}</h4></div>
             <div class="card-body">
             <div class="column">
             <a class="btn btn-default btn-margin" onClick={this.showall}>+ All</a>
             <a class="btn btn-default btn-margin" onClick={this.closeall}>- All</a>
             </div>
             <div class="column2" id="casedistribute">
             <div class={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
             <div class="box-header  ">
               <b class="box-title">ข้อมูลจำแนกงาน</b>
               <br/>
               <br/>


                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
               <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >รหัสงาน</th>
                 <th style={{backgroundColor:'white'}}>&nbsp;{data.id}</th>
               </tr>
               <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
              <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ประเภทของใบงาน</th>
              <th style={{backgroundColor:'white'}}>&nbsp;{
               this.state.casecat.map(
                 data =>
                 <span>{data.name}</span>
               )
             }</th>
              </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
              <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >ชนิดของใบงาน</th>
               <th style={{backgroundColor:'white'}}>&nbsp;{data.case_type.name}</th>
              </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
              <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ชื่อใบงาน</th>
              <th style={{backgroundColor:'white'}}>&nbsp;{data.name}</th>
              </tr>

              </thead>
                </table>
               <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
               </div>

             </div>

             <div class="box-body" style={{}} >
             <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
             <thead>

              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >ชนิดย่อยของใบงาน</th>
               <th style={{backgroundColor:'white'}}>&nbsp;{data.case_sub_type.name}</th>
             </tr>
             <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
            <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >งานเดิม</th>
              <th style={{backgroundColor:'white'}}>&nbsp;{this.oldcase(data)}</th>
            </tr>
            <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
           <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >งานใหม่</th>
             <th style={{backgroundColor:'white'}}>&nbsp;{this.newcase(data)}</th>
           </tr>
             </thead>
             </table>
             </div>
             </div>
             </div>
             <div class="column2" id="casedetail">

             <div class={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
             <div class="box-header  ">
             <b class="box-title" >รายละเอียดงาน</b>
             <br/>
             <br/>


              <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
              <thead>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
              <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ผู้บันทึก/ส่งคำร้อง</th>
               <th style={{backgroundColor:'white'}}>&nbsp;{data.match_id.public_name}</th>
              </tr>
              {this.showuser(data)}
              {this.showcoor(data)}
              {this.showpartner(data)}
              </thead>
              </table>



             <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
             </div>
             </div>
             <div class="box-body" style={{}}>
             <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
             <thead>
             {this.showcasechannel(data)}
             {this.showrefcase(data)}
             {this.showrefasset(data)}
             </thead>
             </table>
             </div>
             </div>
             </div>
             {this.casetracking(data)}
             {this.casedetail(data)}


             <div class="column22" id="customerdetail">
             <div class={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
             <div class="box-header  ">
               <b class="box-title" >ข้อมูลลูกค้า</b>
               <br/>
               <br/>


                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
               <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >ชื่อลูกค้า	</th>
                 <th style={{backgroundColor:'white'}}>&nbsp;{data.person.name} {data.person.lname}</th>
               </tr>
               <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
              <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>เบอร์โทรศัพท์	</th>
                <th style={{backgroundColor:'white'}}>&nbsp;{data.person.mobile}</th>
              </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>E-mail	</th>
               <th style={{backgroundColor:'white'}}>&nbsp;{data.person.email}</th>
             </tr>

              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>Fax</th>
               <th style={{backgroundColor:'white'}}>&nbsp;{data.person.add2_fax}</th>
             </tr>
             <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
            <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ที่อยู่	</th>
            <div style={{overflowX:'auto',height:'60px',backgroundColor:'white',border:'0.5px solid #E3E3E3'}}>  <th style={{backgroundColor:'white'}}>&nbsp;{data.person.add2_sentdoc}</th></div>

            </tr>
               </thead>
                </table>
               <div class="box-tools pull-right">
               </div>
             </div>

             </div>
             </div>

             <div class="column22" id="contactdetail">
             <div class={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
             <div class="box-header  ">
               <b class="box-title" data-widget="collapse">ข้อมูลผู้ติดต่อ</b>
               <br/>
               <br/>


                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
               <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >{data.case_type.requirename_var16}	</th>
                 <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value16}</th>
               </tr>
                <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
               <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var17}	</th>
                 <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value17}</th>
               </tr>
               <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
              <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var18}	</th>
                <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value18}</th>
              </tr>
               <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
              <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var20}</th>
                <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value20}</th>
              </tr>
               <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
              <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.requirename_var19}	</th>
              <div style={{overflowX:'auto',height:'60px',backgroundColor:'white',border:'0.5px solid #E3E3E3'}}>  <th style={{backgroundColor:'white'}}>&nbsp;{data.require_value19}</th></div>
              </tr>
               </thead>
                </table>
               <div class="box-tools pull-right">
               </div>
             </div>

             </div>

             </div>


             <div class="column">
             <div class="column22" id="act">
             <div class={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
             <div class="box-header  ">
               <b class="box-title" data-widget="collapse">พรบ.</b>
               <br/>
               <br/>
                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
               <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >บริษัทประกันที่เลิอก</th>
                 <th style={{backgroundColor:'white'}}>{confirmofferact} </th>
               </tr>
                <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
               <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>Partner (Channel เดิม)</th>
                 <th style={{backgroundColor:'white'}}>{confirmofferactproposal} </th>
               </tr>
               </thead>
                </table>
               <div class="box-tools pull-right">

                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
               </div>
             </div>
             <div class="box-body" style={{}}>
             <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
             <thead>
             <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
            <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ไฟล์สำเนา พรบ.</th>
            {this.copyact(data)}
            </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ได้รับ พรบ.</th>
               <th style={{backgroundColor:'white'}}>&nbsp;</th>
             </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ พรบ. หมดอายุ  (ใหม่)</th>
               <th style={{backgroundColor:'white'}}>&nbsp;</th>
             </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่จัดส่ง พรบ.</th>
               <th style={{backgroundColor:'white'}}>&nbsp;</th>
             </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name38}</th>
               <th style={{backgroundColor:'white'}}>{this.fixact38(data)} </th>
             </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name39}</th>
               <th style={{backgroundColor:'white'}}>{this.fixact39(data)} </th>
             </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name40}</th>
               <th style={{backgroundColor:'white'}}>{this.fixact40(data)}</th>
             </tr>
             </thead>
             </table>
             </div>
             </div>
             <br/>
             <br/>
             </div>
             <div class="column22" id="insuracedetail">
             <div class={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
             <div class="box-header  ">
               <b class="box-title" data-widget="collapse">กรมธรรมภาคสมัครใจ
  </b>
  <br/>
  <br/>


            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
            <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}  >บริษัทประกันที่เลิอก</th>
             <th style={{backgroundColor:'white'}}>{confirmofferinsurancename} </th>
            </tr>
            <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
            <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>Partner (Channel เดิม)</th>
             <th style={{backgroundColor:'white'}}>{confirmofferinsuranceproposal}</th>
            </tr>
            </thead>
                  </table>
               <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
               </div>
             </div>
             <div class="box-body" style={{}}>
             <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
             <thead>


              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ไฟล์สำเนากรมธรรม์</th>
             {this.insurancecopy(data)}
             </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ได้รับ กรมธรรม์</th>
               <th style={{backgroundColor:'white'}}>&nbsp;</th>
             </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ กรมธรรม์ หมดอายุ (ใหม่)</th>
               <th style={{backgroundColor:'white'}}>&nbsp;</th>
             </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่จัดส่ง กรมธรรม์</th>
               <th style={{backgroundColor:'white'}}>&nbsp;</th>
             </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name41}</th>
               <th style={{backgroundColor:'white'}}>{this.fixins41(data)}</th>
             </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name42}</th>
               <th style={{backgroundColor:'white'}}>{this.fixins42(data)}</th>
             </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name43}</th>
               <th style={{backgroundColor:'white'}}>{this.fixins43(data)}</th>
             </tr>
             </thead>
             </table>
             </div>
             </div>
             </div>

             <div class="column22" id="tax">
             <div class={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
             <div class="box-header  ">
               <b class="box-title" data-widget="collapse">ภาษี</b>
               <br/>
               <br/>


                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
               <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่จัดส่ง  ภาษี์</th>
                 <th style={{backgroundColor:'white'}}>&nbsp;</th>
               </tr>

              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name46}</th>
               <th style={{backgroundColor:'white'}}>{this.fixtax46(data)}</th>
             </tr>
             </thead>
                </table>
               <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
               </div>
             </div>
             <div class="box-body" style={{}}>
             <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
             <thead>

              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ไฟล์สำเนาภาษ๊</th>
             {this.taxcopy(data)}
             </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ได้รับ ภาษี</th>
               <th style={{backgroundColor:'white'}}>&nbsp;</th>
             </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>วันที่ ภาษี หมดอาย (ใหม่)</th>
               <th style={{backgroundColor:'white'}}>&nbsp;</th>
             </tr>

              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name44}</th>
               <th style={{backgroundColor:'white'}}>{this.fixtax44(data)}</th>
             </tr>
              <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
             <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>{data.case_type.var_name45}</th>
               <th style={{backgroundColor:'white'}}>{this.fixtax45(data)}</th>
             </tr>
             <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
            <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}></th>
              <th style={{backgroundColor:'#F4F4F6'}}>&nbsp;</th>
            </tr>
            <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
           <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}></th>
             <th style={{backgroundColor:'#F4F4F6'}}>&nbsp;</th>
           </tr>
             </thead>
             </table>
             </div>
             </div>
             </div>
             </div>
             {this.caseasset(data)}
             {this.casepayment(data,confirmofferinsurancename,confirmofferact,confirmoffertax,confirmofferpayment4,confirmofferpayment4act,confirmofferpayment4tax,confirmofferpayment5tax,confirmofferpayment5act,confirmofferpayment5,alldiscount,alldiscountact,alldiscounttax,beforediscount,beforediscountact,beforediscounttax,afterdiscount,afterdiscountact,afterdiscounttax,allpartnerpaid,allpartnerpaidact,allpartnerpaidtax,alluserpaid,alluserpaidact,alluserpaidtax,allcompanypaid,allcompanypaidact,allcompanypaidtax)}
             <div class="column" id="filemain">

             <div class={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
             <div class="box-header  ">
               <b class="box-title" data-widget="collapse">เอกสารหลัก/เอกสารประกอบ</b>
               <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
               </div>
              </div>
               <div class="box-body" >

               <div class="card">
               <div class="card-header">เอกสารหลัก
                <div class="box-tools pull-right">
                              <button style={{display:"none"}}type="button" class="btn btn-box-tool"  onClick={this.loadmemberfile()}><i class="fa fa-plus"></i></button>
                              <button type="button" class="btn btn-box-tool"  onClick={this.reloadmemberfile}><i class={this.state.refresh}></i></button>
                            </div></div>
               <div class="card-body">
               <div class="column5">
                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
               <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>สำเนาบัตรประจำตัวประชาชน</th>
                {this.citizenfile(data)}
               </tr>
                <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
               <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>สำเนาบัตรประจำตัวใบขับขี่</th>
               {this.driverfile(data)}
               </tr>
               <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
               <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>สำเนาบัตรพนักงาน</th>
               {this.employeefile(data)}
               </tr>

               </thead>
                </table>
                </div>
                <div class="column5">
                 <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                 <thead>

                 <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>สลิปเงินเดือน /Salary Slip</th>
                 {this.salaryslipfile(data)}
                 </tr>
                 <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>สำเนาหน้าเล่มรถ</th>
                 {this.carfile(data)}
                 </tr>
                 <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>สำเนากรมธรรม์เดิม (ก่อนทำกับเรา)</th>
                 {this.oldinsurances(data)}
                 </tr>
                </thead>
                 </table>
                 </div>
                 <div class="column5">
                  <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>สำเนาพรบเดิม (ก่อนทำกับเรา)</th>
                 {this.oldact(data)}
                 </tr>
                 <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>สำเนาภาษีเดิม (ก่อนทำกับเรา)</th>
                 {this.oldtax(data)}
                 </tr>
                 <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                 <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ใบรับเงินประกันแทน</th>
                 {this.vehicleinspection(data)}
                 </tr>
                 </thead>
                  </table>
                  </div>
                  <div class="column5">
                   <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                   <thead>

                   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ใบผลตรวจสภาพรถ</th>
                   {this.discountcoupon(data)}
                   </tr>
                   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>บัตรส่วนลด(Coupon)</th>
                   {this.insuranceapplication(data)}
                   </tr>
                   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>สำเนาใบเตือนต่ออายุ </th>
                   {this.guaranteereceipt(data)}
                   </tr>
                  </thead>
                   </table>
                   </div>
                   <div class="column5">
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                    <thead>
                    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>ใบคำขอเอาประกันภัย</th>
                    {this.copyrenewalnotice(data)}
                    </tr>
                   </thead>
                    </table>
                    </div>
                    </div>

                    </div>
                    <br/>

                    <div class="card">
                    <div class="card-header">เอกสารประกอบ </div>
                    <div class="card-body">
                    <div class="column5">
                     <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                     <thead>
                     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>รูปรถยนต์</th>
                    {this.carphoto(data)}
                    </tr>
                     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'40px'}}>รููปกล้องติดรถยนต์</th>
                    {this.carcamera(data)}
                    </tr>
                    </thead>
                     </table>
                     </div>

                     <div class="columnanotherfile">
                     <table id="example2" class="table  table-hover dataTable " role="grid" aria-describedby="example2_info">
                     <thead>
                     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'55px'}}>เอกสารอื่นๆ <a style={{float:'right'}} href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+data.id+"/xxx/CG4CG/Case_Attachment?cat?CA53CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
                    </tr>
                    </thead>
                    <tbody>
                     <div class="tablescroll">
                     {this.state.anotherfile.map(data =>
                       <tr>
                       <th style={{backgroundColor:'white'}}>&nbsp;<a href={'/SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a></th>
                       </tr>
                     )}
                     </div>
                     </tbody>
                     </table>
                      </div>
                     </div>
                     </div>


             </div>
             </div>

             <div class={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
             <div class="box-header  ">
               <b class="box-title" data-widget="collapse">ขั้นตอนงาน / Case Log</b>
               <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
               </div>
              </div>
               <div class="box-body" >
               <div style={{overflowX:'auto'}}>
               <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                   <thead>
                   <tr role="row">
                   <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">วันที่ </th>
                     <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">จากขั้นตอน </th>
                     <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending"> </th>
                       <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ถึงขั้นตอน </th>
                       <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">รายละเอียด </th>

                       </tr>
                   </thead>
                   <tbody>
                    {this.showcaselog(data)}

                   </tbody>
                   </table>
               </div>
               {this.showcasecondition(data)}
               </div>
               </div>
               <div class={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
               <div class="box-header  ">
                 <b class="box-title" data-widget="collapse">Stage Action Log</b>
                 <div class="box-tools pull-right">
                   <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                 </div>
                </div>
                 <div class="box-body" >
                 <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                     <thead>
                     <tr role="row">

                     <th >ขั้นตอนงาน</th>
                     <th >Action</th>
                     <th >เวลา</th>


                     </tr>
                     </thead>
                     <tbody>
                     {this.showcaseaction(data)}
                     </tbody>
                  </table>

                 </div>
                 </div>
             </div>

             </div>

               <div style={{overflowX:'auto'}}>
               <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                   <thead>
                   <tr role="row">

                   <th  colspan="100"  > ข้อเสนอที่แนะนำ <a  href={'/wealththaiinsurance/cases/'+this.state.caseid2+'/offer/show?blink'+this.state.blink}>ดูข้อเสนอทั้งหมด</a> {this.recheckofferbutton(data)}</th>


                   </tr>
                     <tr role="row">

                     <th  colspan="5"  > </th>
                     <th  colspan="5"  style={{textAlign:'center',backgroundColor:"silver"}}>ทุนประกันรถยนต์	 </th>
                     <th  colspan="4"  style={{textAlign:'center',backgroundColor:"silver"}}>ความเสียหายต่อภายนอก</th>
                     </tr>
                     <tr role="row">

                     <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">AI </th>
                       <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ชื่อข้อเสนอ </th>
                       <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ประเภทข้อเสนอ</th>
                       <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">บริษัท</th>
                       <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">สาขา</th>
                       <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ความเสียหายต่อรถยนต์(รถเรา)</th>
                       <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ความเสียหายส่วนแรก(รถเรา)</th>
                       <th  aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">รถยนต์สูญหาย/ไฟใหม้(รถเรา)  </th>
                       <th  aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ความคุ้มครองน้ำท่วม</th>
                       <th  aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">จำนวนคนที่คุ้มครอง</th>
                       <th  aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">วงเงินความเสียหายต่อชีวิตร่างกายภายนอก(เฉพาะส่วนเกินพรบ)/คน</th>
                       <th  aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">วงเงินความเสียหายต่อชีวิตร่างกายภายนอก(เฉพาะส่วนเกินพรบ)/ครั้ง</th>
                       <th  aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ความเสียหายต่อทรัพย์สิน(ภายนอก)</th>
                       <th  aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ความเสียหายส่วนแรก(ภายนอก)</th>

                       <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending"></th>
                     </tr>
                   </thead>
                   <tbody>
                   {this.state.confirmoffer.map(data =>
                                 <tr  style={{backgroundColor:'#72EB00'}}role="row" class="odd">
                                   <th></th>
                                       <th >{data.name}</th>
                                       <th>{data.offer_type.name}</th>
                                       <th>{data.person.name}</th>
                                       {this.showbranchname(data)}
                                       <th>{data.offer_value5}</th>
                                       <th>{data.offer_value6}</th>
                                       <th>{data.offer_value7}</th>
                                       <th>{data.offer_value1}</th>
                                       <th>{data.offer_value14}</th>
                                       <th>{data.offer_value19}</th>
                                       <th>{data.offer_value2}</th>
                                       <th>{data.offer_value3}</th>
                                       <th>{data.offer_value4}</th>

                                       <th>
                                       <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target={"#myModal"+data.id}>รายละเอียด</button>
                                       <div class="modal" id={"myModal"+data.id} role="dialog">
                                         <div class="modal-dialog modal-lg " >
                                         <div class="modal-content">
                                         <div class="modal-header" >
                                         <button style={{float:'right'}}type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                         <h3 class="modal-title">{data.name}</h3>
                                         <p class="modal-title">
                                         <ul class="nav nav-tabs">
                                                   <li class="active"><a data-toggle="tab" href={"#home"+data.id}>รายละเอียดข้อเสนอ</a></li>
                                                   <li><a data-toggle="tab" href={"#menu2"+data.id}>รายละเอียดการชำระเงิน</a></li>
                                        </ul>
                                            </p>
                                         </div>

                                         <div class="tab-content" style={{padding:'10px'}}>
                                           <div id={"home"+data.id} class="tab-pane  in active">
                                             <table class="table" >
                                             <tr>
                                             <th width=""><p>ชื่อข้อเสนอ</p></th>
                                             <th>{data.name}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>ประเภทข้อเสนอ</p></th>
                                             <th >{data.offer_type.name}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>วันที่สร้าง</p></th>
                                             <th >{data.created_date} </th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>วันที่แก้ไขล่าสุด</p></th>
                                             <th >{data.modified_date} </th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>คนสร้าง</p></th>
                                             <th >{data.match_id.public_name} </th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>บริษัท</p></th>
                                             <th >{data.person.name}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>สาขา</p></th>
                                             {this.showbranchname(data)}
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name1} </p></th>
                                             <th >{data.offer_value1}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name2} </p></th>
                                             <th >{data.offer_value2}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name3} </p></th>
                                             <th >{data.offer_value3}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name4} </p></th>
                                             <th >{data.offer_value4}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name5} </p></th>
                                             <th >{data.offer_value5}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name6} </p></th>
                                             <th >{data.offer_value6}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name7} </p></th>
                                             <th >{data.offer_value7}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name8} </p></th>
                                             <th >{data.offer_value8}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name9} </p></th>
                                             <th >{data.offer_value9}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name10} </p></th>
                                             <th >{data.offer_value10}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name11} </p></th>
                                             <th >{data.offer_value11}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name12} </p></th>
                                             <th >{data.offer_value12}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name13} </p></th>
                                             <th >{data.offer_value13}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name14} </p></th>
                                             <th >{data.offer_value14}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name15} </p></th>
                                             <th >{data.offer_value15}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name16} </p></th>
                                             <th >{data.offer_value16}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name17} </p></th>
                                             <th >{data.offer_value17}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name18} </p></th>
                                             <th >{data.offer_value18}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name19} </p></th>
                                             <th >{data.offer_value19}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name20} </p></th>
                                             <th >{data.offer_value20}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name21} </p></th>
                                             <th >{data.offer_value21}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name22} </p></th>
                                             <th >{data.offer_value22}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name23} </p></th>
                                             <th >{data.offer_value23}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name24} </p></th>
                                             <th >{data.offer_value24}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name25} </p></th>
                                             <th >{data.offer_value25}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name26} </p></th>
                                             <th >{data.offer_value26}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name27} </p></th>
                                             <th >{data.offer_value27}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name28} </p></th>
                                             <th >{data.offer_value28}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name29} </p></th>
                                             <th >{data.offer_value29}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name30} </p></th>
                                             <th >{data.offer_value30}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name31} </p></th>
                                             <th >{data.offer_value31}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name32} </p></th>
                                             <th >{data.offer_value32}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name33} </p></th>
                                             <th >{data.offer_value33}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name34} </p></th>
                                             <th >{data.offer_value34}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name35} </p></th>
                                             <th >{data.offer_value35}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name36} </p></th>
                                             <th >{data.offer_value36}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name37} </p></th>
                                             <th >{data.offer_value37}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name38} </p></th>
                                             <th >{data.offer_value38}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name39} </p></th>
                                             <th >{data.offer_value39}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_value_name40} </p></th>
                                             <th >{data.offer_value40}</th>
                                             </tr>
                                             </table>
                                             </div>
                                             <div id={"menu1"+data.id} class="tab-pane ">
                                             <table class="table" >

                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name1} </p></th>
                                             <th >{data.offer_payment_value1}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name2} </p></th>
                                             <th >{data.offer_payment_value2}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name3} </p></th>
                                             <th >{data.offer_payment_value3}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name4} </p></th>
                                             <th >{data.offer_payment_value4}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name5} </p></th>
                                             <th >{data.offer_payment_value5}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name6} </p></th>
                                             <th >{data.offer_payment_value6}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name7} </p></th>
                                             <th >{data.offer_payment_value7}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name8} </p></th>
                                             <th >{data.offer_payment_value8}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name9} </p></th>
                                             <th >{data.offer_payment_value9}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name10} </p></th>
                                             <th >{data.offer_payment_value10}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name11} </p></th>
                                             <th >{data.offer_payment_value11}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name12} </p></th>
                                             <th >{data.offer_payment_value12}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name13} </p></th>
                                             <th >{data.offer_payment_value13}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name14} </p></th>
                                             <th >{data.offer_payment_value14}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name15} </p></th>
                                             <th >{data.offer_payment_value15}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name16} </p></th>
                                             <th >{data.offer_payment_value16}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name17} </p></th>
                                             <th >{data.offer_payment_value17}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name18} </p></th>
                                             <th >{data.offer_payment_value18}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name19} </p></th>
                                             <th >{data.offer_payment_value19}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name20} </p></th>
                                             <th >{data.offer_payment_value20}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name21} </p></th>
                                             <th >{data.offer_payment_value21}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name22} </p></th>
                                             <th >{data.offer_payment_value22}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name23} </p></th>
                                             <th >{data.offer_payment_value23}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name24} </p></th>
                                             <th >{data.offer_payment_value24}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name25} </p></th>
                                             <th >{data.offer_payment_value25}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name26} </p></th>
                                             <th >{data.offer_payment_value26}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name27} </p></th>
                                             <th >{data.offer_payment_value27}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name28} </p></th>
                                             <th >{data.offer_payment_value28}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name29} </p></th>
                                             <th >{data.offer_payment_value29}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name30} </p></th>
                                             <th >{data.offer_payment_value30}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name31} </p></th>
                                             <th >{data.offer_payment_value31}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name32} </p></th>
                                             <th >{data.offer_payment_value32}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name33} </p></th>
                                             <th >{data.offer_payment_value33}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name34} </p></th>
                                             <th >{data.offer_payment_value34}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name35} </p></th>
                                             <th >{data.offer_payment_value35}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name36} </p></th>
                                             <th >{data.offer_payment_value36}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name37} </p></th>
                                             <th >{data.offer_payment_value37}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name38} </p></th>
                                             <th >{data.offer_payment_value38}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name39} </p></th>
                                             <th >{data.offer_payment_value39}</th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>{data.offer_type.offer_payment_name40} </p></th>
                                             <th >{data.offer_payment_value40}</th>
                                             </tr>
                                             </table>
                                             </div>
                                             <div id={"menu2"+data.id} class="tab-pane ">
                                             <table class="table" >

                                             <tr>
                                             <th width=""><p>เบี้ยรวมหน้าตั๋ว</p></th>
                                             <th ></th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</p></th>
                                             <th ></th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>ส่วนลดพิเศษทั้งหมด </p></th>
                                             <th ></th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</p></th>
                                             <th ></th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</p></th>
                                             <th ></th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </p></th>
                                             <th ></th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User)</p></th>
                                             <th ></th>
                                             </tr>
                                             <tr>
                                             <th width=""><p>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company)</p></th>
                                             <th ></th>
                                             </tr>
                                             </table>
                                             </div>
                                             </div>
                                             </div></div></div></th>


                                     </tr>
                   )}
               {this.state.intertestoffer.map(data =>
                   <tr  style={{backgroundColor:'yellow'}}role="row" class="odd">
                     <th></th>
                         <th >{data.name}</th>
                         <th>{data.offer_type.name}</th>
                         <th>{data.person.name}</th>
                         {this.showbranchname(data)}
                         <th>{data.offer_value5}</th>
                         <th>{data.offer_value6}</th>
                         <th>{data.offer_value7}</th>
                         <th>{data.offer_value1}</th>
                         <th>{data.offer_value14}</th>
                         <th>{data.offer_value19}</th>
                         <th>{data.offer_value2}</th>
                         <th>{data.offer_value3}</th>
                         <th>{data.offer_value4}</th>

                         <th>
                         <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target={"#myModal"+data.id}>รายละเอียด</button>
                         <div class="modal" id={"myModal"+data.id} role="dialog">
                           <div class="modal-dialog modal-lg " >
                           <div class="modal-content">
                           <div class="modal-header" >
                           <button style={{float:'right'}}type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           <h3 class="modal-title">{data.name}</h3>
                           <p class="modal-title">
                           <ul class="nav nav-tabs">
                                     <li class="active"><a data-toggle="tab" href={"#home"+data.id}>รายละเอียดข้อเสนอ</a></li>
                                     <li><a data-toggle="tab" href={"#menu1"+data.id}>รายละเอียดการชำระเงิน</a></li>
                                     <li><a data-toggle="tab" href={"#menu2"+data.id}>มูลค่าเบี้ย</a></li>
                                     </ul>
                              </p>

                           </div>

                           <div class="tab-content" style={{padding:'10px'}}>
                             <div id={"home"+data.id} class="tab-pane  in active">
                               <table class="table " >
                               <tr>
                               <th width=""><p>ชื่อข้อเสนอ</p></th>
                               <th >{data.name}</th>
                               </tr>
                               <tr>
                               <th width=""><p>ประเภทข้อเสนอ</p></th>
                               <th >{data.offer_type.name} </th>
                               </tr>
                               <tr>
                               <th width=""><p>วันที่สร้าง</p></th>
                               <th >{data.created_date} </th>
                               </tr>
                               <tr>
                               <th width=""><p>วันที่แก้ไขล่าสุด</p></th>
                               <th >{data.modified_date} </th>
                               </tr>
                               <tr>
                               <th width=""><p>คนสร้าง</p></th>
                               <th >{data.match_id.public_name} </th>
                               </tr>
                               <tr>
                               <th width=""><p>บริษัท</p></th>
                               <th >{data.person.name}</th>
                               </tr>
                               <tr>
                               <th width=""><p>สาขา</p></th>
                               {this.showbranchname(data)}
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name1} </p></th>
                               <th >{data.offer_value1}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name2} </p></th>
                               <th >{data.offer_value2}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name3} </p></th>
                               <th >{data.offer_value3}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name4} </p></th>
                               <th >{data.offer_value4}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name5} </p></th>
                               <th >{data.offer_value5}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name6} </p></th>
                               <th >{data.offer_value6}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name7} </p></th>
                               <th >{data.offer_value7}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name8} </p></th>
                               <th >{data.offer_value8}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name9} </p></th>
                               <th >{data.offer_value9}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name10} </p></th>
                               <th >{data.offer_value10}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name11} </p></th>
                               <th >{data.offer_value11}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name12} </p></th>
                               <th >{data.offer_value12}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name13} </p></th>
                               <th >{data.offer_value13}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name14} </p></th>
                               <th >{data.offer_value14}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name15} </p></th>
                               <th >{data.offer_value15}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name16} </p></th>
                               <th >{data.offer_value16}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name17} </p></th>
                               <th >{data.offer_value17}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name18} </p></th>
                               <th >{data.offer_value18}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name19} </p></th>
                               <th >{data.offer_value19}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name20} </p></th>
                               <th >{data.offer_value20}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name21} </p></th>
                               <th >{data.offer_value21}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name22} </p></th>
                               <th >{data.offer_value22}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name23} </p></th>
                               <th >{data.offer_value23}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name24} </p></th>
                               <th >{data.offer_value24}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name25} </p></th>
                               <th >{data.offer_value25}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name26} </p></th>
                               <th >{data.offer_value26}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name27} </p></th>
                               <th >{data.offer_value27}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name28} </p></th>
                               <th >{data.offer_value28}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name29} </p></th>
                               <th >{data.offer_value29}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name30} </p></th>
                               <th >{data.offer_value30}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name31} </p></th>
                               <th >{data.offer_value31}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name32} </p></th>
                               <th >{data.offer_value32}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name33} </p></th>
                               <th >{data.offer_value33}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name34} </p></th>
                               <th >{data.offer_value34}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name35} </p></th>
                               <th >{data.offer_value35}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name36} </p></th>
                               <th >{data.offer_value36}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name37} </p></th>
                               <th >{data.offer_value37}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name38} </p></th>
                               <th >{data.offer_value38}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name39} </p></th>
                               <th >{data.offer_value39}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_value_name40} </p></th>
                               <th >{data.offer_value40}</th>
                               </tr>
                               </table>
                               </div>
                               <div id={"menu1"+data.id} class="tab-pane ">
                               <table class="table" >

                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name1} </p></th>
                               <th >{data.offer_payment_value1}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name2} </p></th>
                               <th >{data.offer_payment_value2}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name3} </p></th>
                               <th >{data.offer_payment_value3}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name4} </p></th>
                               <th >{data.offer_payment_value4}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name5} </p></th>
                               <th >{data.offer_payment_value5}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name6} </p></th>
                               <th >{data.offer_payment_value6}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name7} </p></th>
                               <th >{data.offer_payment_value7}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name8} </p></th>
                               <th >{data.offer_payment_value8}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name9} </p></th>
                               <th >{data.offer_payment_value9}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name10} </p></th>
                               <th >{data.offer_payment_value10}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name11} </p></th>
                               <th >{data.offer_payment_value11}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name12} </p></th>
                               <th >{data.offer_payment_value12}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name13} </p></th>
                               <th >{data.offer_payment_value13}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name14} </p></th>
                               <th >{data.offer_payment_value14}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name15} </p></th>
                               <th >{data.offer_payment_value15}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name16} </p></th>
                               <th >{data.offer_payment_value16}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name17} </p></th>
                               <th >{data.offer_payment_value17}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name18} </p></th>
                               <th >{data.offer_payment_value18}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name19} </p></th>
                               <th >{data.offer_payment_value19}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name20} </p></th>
                               <th >{data.offer_payment_value20}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name21} </p></th>
                               <th >{data.offer_payment_value21}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name22} </p></th>
                               <th >{data.offer_payment_value22}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name23} </p></th>
                               <th >{data.offer_payment_value23}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name24} </p></th>
                               <th >{data.offer_payment_value24}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name25} </p></th>
                               <th >{data.offer_payment_value25}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name26} </p></th>
                               <th >{data.offer_payment_value26}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name27} </p></th>
                               <th >{data.offer_payment_value27}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name28} </p></th>
                               <th >{data.offer_payment_value28}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name29} </p></th>
                               <th >{data.offer_payment_value29}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name30} </p></th>
                               <th >{data.offer_payment_value30}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name31} </p></th>
                               <th >{data.offer_payment_value31}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name32} </p></th>
                               <th >{data.offer_payment_value32}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name33} </p></th>
                               <th >{data.offer_payment_value33}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name34} </p></th>
                               <th >{data.offer_payment_value34}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name35} </p></th>
                               <th >{data.offer_payment_value35}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name36} </p></th>
                               <th >{data.offer_payment_value36}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name37} </p></th>
                               <th >{data.offer_payment_value37}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name38} </p></th>
                               <th >{data.offer_payment_value38}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name39} </p></th>
                               <th >{data.offer_payment_value39}</th>
                               </tr>
                               <tr>
                               <th width=""><p>{data.offer_type.offer_payment_name40} </p></th>
                               <th >{data.offer_payment_value40}</th>
                               </tr>
                               </table>
                               </div>
                               <div id={"menu2"+data.id} class="tab-pane ">
                               <table class="table" >

                               <tr>
                               <th width=""><p>เบี้ยรวมหน้าตั๋ว</p></th>
                               <th ></th>
                               </tr>
                               <tr>
                               <th width=""><p>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</p></th>
                               <th ></th>
                               </tr>
                               <tr>
                               <th width=""><p>ส่วนลดพิเศษทั้งหมด </p></th>
                               <th ></th>
                               </tr>
                               <tr>
                               <th width=""><p>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</p></th>
                               <th ></th>
                               </tr>
                               <tr>
                               <th width=""><p>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</p></th>
                               <th ></th>
                               </tr>
                               <tr>
                               <th width=""><p>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </p></th>
                               <th ></th>
                               </tr>
                               <tr>
                               <th width=""><p>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User)</p></th>
                               <th ></th>
                               </tr>
                               <tr>
                               <th width=""><p>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company)</p></th>
                               <th ></th>
                               </tr>
                               </table>
                               </div>
                               </div>
                               </div></div></div></th>


                       </tr>
               )}
               {this.state.lastestoffer.map(data =>
                  <tr  style={{}}role="row" class="odd">
                  <th></th>
                      <th >{data.name}</th>
                      <th>{data.offer_type.name}</th>
                      <th>{data.person.name}</th>
                      {this.showbranchname(data)}
                      <th>{data.offer_value5}</th>
                      <th>{data.offer_value6}</th>
                      <th>{data.offer_value7}</th>
                      <th>{data.offer_value1}</th>
                      <th>{data.offer_value2}</th>
                      <th>{data.offer_value3}</th>
                      <th>{data.offer_value4}</th>

                      <th>
                      <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target={"#myModal"+data.id}>รายละเอียด</button>
                      <div class="modal" id={"myModal"+data.id} role="dialog">
                        <div class="modal-dialog modal-lg " >
                        <div class="modal-content">
                        <div class="modal-header" >
                        <button style={{float:'right'}}type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <h3 class="modal-title">{data.name}</h3>
                        <p class="modal-title">
                        <ul class="nav nav-tabs">
                                  <li class="active"><a data-toggle="tab" href={"#home"+data.id}>รายละเอียดข้อเสนอ</a></li>
                                  <li><a data-toggle="tab" href={"#menu1"+data.id}>รายละเอียดการชำระเงิน</a></li>
                                  <li><a data-toggle="tab" href={"#menu2"+data.id}>มูลค่าเบี้ย</a></li>
                                  </ul>
                           </p>

                        </div>

                        <div class="tab-content" style={{padding:'10px'}}>
                          <div id={"home"+data.id} class="tab-pane  in active">
                            <table class="table " >
                            <tr>
                            <th width=""><p>ชื่อข้อเสนอ</p></th>
                            <th >{data.name}</th>
                            </tr>
                            <tr>
                            <th width=""><p>ประเภทข้อเสนอ</p></th>
                            <th >{data.offer_type.name} </th>
                            </tr>
                            <tr>
                            <th width=""><p>วันที่สร้าง</p></th>
                            <th >{data.created_date} </th>
                            </tr>
                            <tr>
                            <th width=""><p>วันที่แก้ไขล่าสุด</p></th>
                            <th >{data.modified_date} </th>
                            </tr>
                            <tr>
                            <th width=""><p>คนสร้าง</p></th>
                            <th >{data.match_id.public_name} </th>
                            </tr>
                            <tr>
                            <th width=""><p>บริษัท</p></th>
                            <th >{data.person.name}</th>
                            </tr>
                            <tr>
                            <th width=""><p>สาขา</p></th>
                            {this.showbranchname(data)}
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name1} </p></th>
                            <th >{data.offer_value1}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name2} </p></th>
                            <th >{data.offer_value2}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name3} </p></th>
                            <th >{data.offer_value3}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name4} </p></th>
                            <th >{data.offer_value4}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name5} </p></th>
                            <th >{data.offer_value5}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name6} </p></th>
                            <th >{data.offer_value6}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name7} </p></th>
                            <th >{data.offer_value7}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name8} </p></th>
                            <th >{data.offer_value8}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name9} </p></th>
                            <th >{data.offer_value9}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name10} </p></th>
                            <th >{data.offer_value10}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name11} </p></th>
                            <th >{data.offer_value11}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name12} </p></th>
                            <th >{data.offer_value12}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name13} </p></th>
                            <th >{data.offer_value13}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name14} </p></th>
                            <th >{data.offer_value14}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name15} </p></th>
                            <th >{data.offer_value15}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name16} </p></th>
                            <th >{data.offer_value16}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name17} </p></th>
                            <th >{data.offer_value17}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name18} </p></th>
                            <th >{data.offer_value18}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name19} </p></th>
                            <th >{data.offer_value19}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name20} </p></th>
                            <th >{data.offer_value20}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name21} </p></th>
                            <th >{data.offer_value21}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name22} </p></th>
                            <th >{data.offer_value22}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name23} </p></th>
                            <th >{data.offer_value23}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name24} </p></th>
                            <th >{data.offer_value24}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name25} </p></th>
                            <th >{data.offer_value25}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name26} </p></th>
                            <th >{data.offer_value26}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name27} </p></th>
                            <th >{data.offer_value27}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name28} </p></th>
                            <th >{data.offer_value28}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name29} </p></th>
                            <th >{data.offer_value29}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name30} </p></th>
                            <th >{data.offer_value30}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name31} </p></th>
                            <th >{data.offer_value31}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name32} </p></th>
                            <th >{data.offer_value32}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name33} </p></th>
                            <th >{data.offer_value33}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name34} </p></th>
                            <th >{data.offer_value34}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name35} </p></th>
                            <th >{data.offer_value35}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name36} </p></th>
                            <th >{data.offer_value36}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name37} </p></th>
                            <th >{data.offer_value37}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name38} </p></th>
                            <th >{data.offer_value38}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name39} </p></th>
                            <th >{data.offer_value39}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name40} </p></th>
                            <th >{data.offer_value40}</th>
                            </tr>
                            </table>
                            </div>
                            <div id={"menu1"+data.id} class="tab-pane ">
                            <table class="table" >

                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name1} </p></th>
                            <th >{data.offer_payment_value1}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name2} </p></th>
                            <th >{data.offer_payment_value2}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name3} </p></th>
                            <th >{data.offer_payment_value3}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name4} </p></th>
                            <th >{data.offer_payment_value4}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name5} </p></th>
                            <th >{data.offer_payment_value5}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name6} </p></th>
                            <th >{data.offer_payment_value6}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name7} </p></th>
                            <th >{data.offer_payment_value7}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name8} </p></th>
                            <th >{data.offer_payment_value8}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name9} </p></th>
                            <th >{data.offer_payment_value9}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name10} </p></th>
                            <th >{data.offer_payment_value10}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name11} </p></th>
                            <th >{data.offer_payment_value11}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name12} </p></th>
                            <th >{data.offer_payment_value12}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name13} </p></th>
                            <th >{data.offer_payment_value13}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name14} </p></th>
                            <th >{data.offer_payment_value14}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name15} </p></th>
                            <th >{data.offer_payment_value15}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name16} </p></th>
                            <th >{data.offer_payment_value16}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name17} </p></th>
                            <th >{data.offer_payment_value17}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name18} </p></th>
                            <th >{data.offer_payment_value18}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name19} </p></th>
                            <th >{data.offer_payment_value19}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name20} </p></th>
                            <th >{data.offer_payment_value20}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name21} </p></th>
                            <th >{data.offer_payment_value21}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name22} </p></th>
                            <th >{data.offer_payment_value22}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name23} </p></th>
                            <th >{data.offer_payment_value23}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name24} </p></th>
                            <th >{data.offer_payment_value24}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name25} </p></th>
                            <th >{data.offer_payment_value25}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name26} </p></th>
                            <th >{data.offer_payment_value26}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name27} </p></th>
                            <th >{data.offer_payment_value27}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name28} </p></th>
                            <th >{data.offer_payment_value28}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name29} </p></th>
                            <th >{data.offer_payment_value29}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name30} </p></th>
                            <th >{data.offer_payment_value30}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name31} </p></th>
                            <th >{data.offer_payment_value31}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name32} </p></th>
                            <th >{data.offer_payment_value32}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name33} </p></th>
                            <th >{data.offer_payment_value33}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name34} </p></th>
                            <th >{data.offer_payment_value34}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name35} </p></th>
                            <th >{data.offer_payment_value35}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name36} </p></th>
                            <th >{data.offer_payment_value36}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name37} </p></th>
                            <th >{data.offer_payment_value37}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name38} </p></th>
                            <th >{data.offer_payment_value38}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name39} </p></th>
                            <th >{data.offer_payment_value39}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_payment_name40} </p></th>
                            <th >{data.offer_payment_value40}</th>
                            </tr>
                            </table>
                            </div>
                            <div id={"menu2"+data.id} class="tab-pane ">
                            <table class="table" >

                            <tr>
                            <th width=""><p>เบี้ยรวมหน้าตั๋ว</p></th>
                            <th >{data.offer_payment_value4}</th>
                            </tr>
                            <tr>
                            <th width=""><p>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</p></th>
                            <th ></th>
                            </tr>
                            <tr>
                            <th width=""><p>ส่วนลดพิเศษทั้งหมด </p></th>
                            <th ></th>
                            </tr>
                            <tr>
                            <th width=""><p>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</p></th>
                            <th ></th>
                            </tr>
                            <tr>
                            <th width=""><p>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</p></th>
                            <th ></th>
                            </tr>
                            <tr>
                            <th width=""><p>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </p></th>
                            <th ></th>
                            </tr>
                            <tr>
                            <th width=""><p>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User)</p></th>
                            <th ></th>
                            </tr>
                            <tr>
                            <th width=""><p>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company)</p></th>
                            <th ></th>
                            </tr>
                            </table>
                            </div>
                            </div>
                            </div></div></div></th>


                      </tr>
               )}
                       </tbody>


               </table>
             </div>
      </div>
      )}
      </div>
  }
  render () {
    const { confirmoffer } = this.state
    return confirmoffer.length ? this.showdetail() : (
      <span style={{textAlign:'center'}}>กำลังโหลดข้อมูล..</span>
    )
  }
}

if (document.getElementById('insuranceshowdetail')) {
  const component = document.getElementById('insuranceshowdetail');
      const props = Object.assign({}, component.dataset);
    ReactDOM.render(<InsuranceShowdetail {...props}/>,component);
}

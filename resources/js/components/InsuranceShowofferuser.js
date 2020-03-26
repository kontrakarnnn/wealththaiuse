import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import ReactTable from 'react-table'
import 'react-table/react-table.css'
import Dialog from 'react-dialog'
import Picky from 'react-picky';
import 'react-picky/dist/picky.css'; // Include CSS
import Modal from 'react-awesome-modal';

export default class InsuranceShowofferuser extends Component {

  constructor(){
    super();
    ////console.log(super());
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
      data:'',
      caseid2:'',
      blink:'#',
      currenturl:'#',

    };
    this.openclassicview = this.openclassicview.bind(this);
    this.closeclassicview = this.closeclassicview.bind(this);
    this.editCliente = this.editCliente.bind(this);
    this.onClickProposal = this.onClickProposal.bind(this);
    this.clickoffer = this.clickoffer.bind(this);
    this.handleInterestOffer = this.handleInterestOffer.bind(this);
    this.handleChangeProposalname = this.handleChangeProposalname.bind(this);//หน้ารวมข้อเสนอ
    this.handleSubmitProposal = this.handleSubmitProposal.bind(this);//หน้ารวมข้อเสนอ
    this.handleChangePartnerblock = this.handleChangePartnerblock.bind(this);//หน้ารวมข้อเสนอ
    this.handleChangeProposaldescription = this.handleChangeProposaldescription.bind(this);//หน้ารวมข้อเสนอ
    this.handleEditProposal = this.handleEditProposal.bind(this);//หน้ารวมข้อเสนอ
    this.SeeallOffer = this.SeeallOffer.bind(this);//หน้ารวมข้อเสนอ
    this.submitconfirmoffer = this.submitconfirmoffer.bind(this);//หน้ารวมข้อเสนอ
    this.handleSelectOffer = this.handleSelectOffer.bind(this);//หน้ารวมข้อเสนอ

  }

  componentDidMount(){
    //console.log(window.location.href);
    const url = window.location.href;
    let backlink = url.split('?blink');
    let splitcaseid = url.split('/wealththaiinsurance/casesuser/');
        splitcaseid  =splitcaseid[1].split('/offer')
    console.log("Leetsee"+backlink[1])
    this.setState({currenturl:url});
    axios.get('/wealththaiinsurance/casesdetail/'+splitcaseid[0]+'/detail/show').then(res=>{
      this.setState({filcase:res.data,caseid2:splitcaseid[0],blink:backlink[1]});
      res.data.map( data=>this.state.data = data)

    }
  ).catch(errors=>{
      //console.log(errors);
    })
    axios.get('/wealththaiinsurance/load/proposal?filterproposal'+splitcaseid[0]).then(response=>{
        this.setState({proposal:response.data});
      }).catch(errors=>{
        //console.log(errors);
      })
      axios.get('/wealththaiinsurance/alloffer/load?filteroffer'+splitcaseid[0]).then(response=>{
        this.setState({alloffer:response.data});
      }).catch(errors=>{
        //console.log(errors);
      })
      axios.get('/wealththaiinsurance/alloffer/load?filteroffer'+splitcaseid[0]).then(response=>{
        this.setState({offer:response.data});
      }).catch(errors=>{
        //console.log(errors);
      })
       axios.get('/wealththaiinsurance/load/partner').then(response=>{
            this.setState({partnerblock:response.data});
          })
          axios.get('/wealththaiinsurance/load/confirmoffer?filteroffer'+splitcaseid[0]).then(response=>{
              this.setState({arrayconfirmoffer:response.data});
            }).catch(errors=>{
              //console.log(errors);
            })
  /////////////////////
  }
  submitconfirmoffer()
  {
    this.setState({showalertmessage:1})
    axios.post('/wealththaiinsurance/store/caseproposaloffer',{
      caseid:this.state.caseid2,
      offerid:this.state.arrayconfirmoffer,
       assetid : this.state.data.referal_asset,
       portid : this.state.data.asset.port_id,
     }).then(res=>{
      //console.log(res.data);
    });
  }
  SeeallOffer()
  {
    //console.log('why')
    axios.get('/wealththaiinsurance/alloffer/load?filteroffer'+this.state.caseid2).then(response=>{
      this.setState({alloffer:response.data});
    }).catch(errors=>{
      //console.log(errors);
    })
  }
  handleChangePartnerblock(e){
    console.count('onChange')
        //console.log("Val", e.id);
        this.setState({ partnerblockid: e.id,partnerblockname:e });
  }
  companymiss(data)
  {
    if(this.state.companymissflag == 0)
    {
      this.state.companymiss = data.offer_payment_value20;

    }
    else
    {
      this.state.companymiss = this.state.companymiss;
    }
    this.state.netpremiumcompanymiss = this.state.netpremiumcompany-this.state.companymiss;

    return <div class="input-group date">

    <input id="email" type="text" class="form-control" readOnly name="email" onChange={this.handlechangecompanymiss} value={this.state.companymiss} />
    <div class="input-group-addon">
        บาท
    </div>
    </div>
  }
  concludiscount(data)
  {
    this.state.concludiscount = data.offer_payment_value15;
    return <div class="input-group date">

    <input id="email" type="text" class="form-control" readOnly name="email" onChange={this.handlechangespecialdiscount} value={this.state.concludiscount} />
    <div class="input-group-addon">
        บาท
    </div>
    </div>
  }
  discountfromcompany(data)
  {
    if(this.state.discountcompanyflag == 0)
    {
      this.state.discountcompany = data.offer_payment_value14;

    }
    else
    {
      this.state.discountcompany = this.state.discountcompany;
    }
    this.state.netpremiumcompany = this.state.netpremiumuserlv-this.state.discountcompany;

    return <div class="input-group date">

    <input id="email" type="text" class="form-control" readOnly name="email" onChange={this.handlechangecompany} value={this.state.discountcompany} />
    <div class="input-group-addon">
        บาท
    </div>
    </div>
  }
  servicefeeuser(data)
  {
    this.state.servicefeeforcal = data.offer_payment_value19;
    if(this.state.servicefeeflag == 0)
    {
      this.state.servicefee = data.offer_payment_value19;

    }
    else
    {
      this.state.servicefee = data.offer_payment_value19 - this.state.discountuserlv ;
    }
    return <div class="input-group date">

    <input id="email" type="text" class="form-control" readOnly name="email"  value={Number(this.state.servicefee).toFixed(2)} />
    <div class="input-group-addon">
        บาท
    </div>
    </div>
  }
  discountfromuserlevel(data)
  {
    if(this.state.discountuserlvflag == 0)
    {
      this.state.discountuserlv = data.offer_payment_value18;

    }

    else
    {
      this.state.discountuserlv = this.state.discountuserlv;
    }
    this.state.netpremiumuserlv = this.state.netpremiumpartnerlv-this.state.discountuserlv
    return <div class="input-group date">

    <input id="" type="text" class="form-control" name="" onChange={this.handlechangeuserlevel} value={this.state.discountuserlv} />
    <div class="input-group-addon">
      บาท
    </div>
    </div>
  }
  discountfrompartnerlevel(data)
  {
    if(this.state.discountpartnerlvflag == 0)
    {
      this.state.discountpartnerlv = data.offer_payment_value16;

    }
    else
    {
      this.state.discountpartnerlv = this.state.discountpartnerlv;
    }
    this.state.netpremiumpartnerlv = this.state. netpremiumcustomerlv-this.state.discountpartnerlv
    return <div class="input-group date">

    <input id="email" type="text" class="form-control" readOnly name="email" onChange={this.handlechangepartnerlevel} value={this.state.discountpartnerlv} />
    <div class="input-group-addon">
        บาท
    </div>
    </div>
  }
  discountfromcustomerlevel(data)
  {
    if(this.state.discountcustomerlvflag == 0)
    {
      this.state.discountcustomerlv = data.offer_payment_value13;
      this.state.netpremiumcustomerlv = this.state.netpremiumpromotion-this.state.discountcustomerlv;

    }
    else if(this.state.discountcustomerlvflag == 3)
    {
      this.state.discountcustomerlv = '';

    }
    else
    {
      this.state.discountcustomerlv = this.state.discountcustomerlv;
    }
    this.state.netpremiumcustomerlv = this.state.netpremiumpromotion-this.state.discountcustomerlv;

    return <div class="input-group date">

    <input id="email" type="email" class="form-control" readOnly name="email" onChange={this.handlechangecustomerlevel} value={this.state.discountcustomerlv} />
    <div class="input-group-addon">
        บาท
    </div>
    </div>
  }
  discountfrompromotion(data)
  {
    if(this.state.discountpromoflag == 0)
    {
      this.state.discountpromo = data.offer_payment_value12;
    }
    else
    {
      this.state.discountpromo = this.state.discountpromo;
    }
    this.state.netpremiumpromotion = this.state.allpremium-this.state.discountpromo;

    return                             <div class="input-group date">

    <input id="email" type="text" class="form-control" readOnly name="email"  value={this.state.discountpromo} />
    <div class="input-group-addon">
        บาท
    </div>
    </div>
  }
  allpremium(data)
  {
    if(this.state.allpremium == 0)
    {
      this.state.allpremium = data.offer_payment_value4;
    }
    else
    {
      this.state.allpremium = this.state.allpremium;
    }
    return <div class="input-group date">

    <input id="email" type="email" class="form-control" readOnly name="email" onChange={this.handlechangeallpremium} value={this.state.allpremium} />
    <div class="input-group-addon">
        บาท
    </div>
    </div>
  }
  netpremium(data)
  {
    if(this.state.netpremiumflag == 0)
    {
      this.state.netpremium = data.offer_payment_value1;
    }
    else
    {
      this.state.netpremium = this.state.netpremium;
    }
    return <div class="input-group date">

    <input id="email" type="text" class="form-control" readOnly name="email" onChange={this.handlechangenetpremium} value={this.state.netpremium} />
    <div class="input-group-addon">
        บาท
    </div>
    </div>
  }
  handleInterestOffer(data){
    if(data.interest == "1")
    {
      axios.post('/wealththaiinsurance/update/offer',{
        caseid:this.state.caseid2,
        offerid:data.id,
        flaginterest:0,
      }).then(res=>{
        //console.log(res.data);
        this.setState({
          alloffer:res.data,
          chkbox:'checked'
        })
      });
  }
    else {
      axios.post('/wealththaiinsurance/update/offer',{
        caseid:this.state.caseid2,
        offerid:data.id,
        flaginterest:1,
      }).then(res=>{
        //console.log(res.data);
        this.setState({
          alloffer:res.data,
        })
      });

      //member
    }
    axios.get('/wealththaiinsurance/load/confirmoffer?filteroffer'+this.state.caseid2).then(response=>{
        this.setState({arrayconfirmoffer:response.data});
      }).catch(errors=>{
        //console.log(errors);
      })


  /*  this.setState({
      name:e.target.value,
    })*/
  }
  totalpaidcompany(data)
  {
    let ans= Number(data.offer_payment_value4) - Number(data.offer_payment_value8) - Number(data.offer_payment_value5);
      return ans;
  }

  totalpaiduser(data)
  {
    let ans= Number(data.offer_payment_value15) + Number(data.offer_payment_value16) + Number(data.offer_payment_value20);
    let ans2 = Number(data.offer_payment_value4) - Number(ans);
    let ans3 = Number(ans2) - Number(data.offer_payment_value5);
    let ans4 = Number(ans3) - Number(data.offer_payment_value19);
      return ans4;
  }
  totalpaidpartner(data)
  {
    let ans= Number(data.offer_payment_value15) + Number(data.offer_payment_value16) + Number(data.offer_payment_value20);
    let ans2 = Number(data.offer_payment_value4) - Number(ans);
    let ans3 = Number(ans2) - Number(data.offer_payment_value5);
    let ans4 = Number(ans3) - Number(data.offer_payment_value17);
      return ans4;
  }
  calculateAfterwithholding(data)
  {
    let ans= Number(data.offer_payment_value15) + Number(data.offer_payment_value16) + Number(data.offer_payment_value20);
    let ans2 = Number(data.offer_payment_value4) - Number(ans);
    let ans3 = Number(ans2) - Number(data.offer_payment_value5);
      return ans3;
  }
  calculateBeforewithholding(data)
  {
    let ans= Number(data.offer_payment_value15) + Number(data.offer_payment_value16) + Number(data.offer_payment_value20);
    let ans2 = Number(data.offer_payment_value4) - Number(ans);
      return ans2;
  }
  calculateallduscount(data)
  {
    let ans= Number(data.offer_payment_value15) + Number(data.offer_payment_value16) + Number(data.offer_payment_value18) + Number(data.offer_payment_value20);
      return ans;
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
  promotion(data)
  {
    if(data.promotion_id == 0 ||data.promotion_id == null ||data.promotion_id == '' )
    {
      return <th></th>
    }
    else
    {
      return <th>{data.promotion.name}</th>
    }
  }
  campaign(data)
  {
    if(data.campaign_id == 0 ||data.campaign_id == null ||data.campaign_id == '' )
    {
      return <th></th>
    }
    else
    {
      return <th>{data.campaign.name}</th>
    }
  }
  handleSelectOffer(e){
    //console.log(e.target.checked)
    if(e.target.checked === true)
    {
      this.state.arrayconfirmoffer.push(e.target.value)
    //console.log(this.state.arrayconfirmoffer,'id'+e.target.value);
  }
    else if(e.target.checked === false) {
      this.setState({
        chkbox:'',
      })
      const n = this.state.arrayconfirmoffer.indexOf(e.target.value);
      this.state.arrayconfirmoffer.splice(n)
      //console.log(this.state.arrayconfirmoffer,'idelse'+e.target.value,'number'+n);
    }
  }
  checkboxinterest(data)
  {
    if(data.interest ==1)
    {

    return <i style={{fontSize:'16px',color:'gold'}} class="fa fa-star " onClick={this.handleInterestOffer.bind(this, data)}></i>
  }
  else
  {
    return <i style={{fontSize:'16px'}} class="fa fa-star-o" onClick={this.handleInterestOffer.bind(this, data)}></i>

  }
  }
  showcheckbox(data){
    let a = this.state.arrayconfirmoffer.indexOf(data.id);
    //console.log("WHY"+this.state.arrayconfirmoffer);
    if(a > -1)
    {
      this.state.chkbox = "checked";
      return <input type="checkbox" defaultChecked={this.state.chkbox} onClick={this.handleSelectOffer} value={data.id} />
    }
    else
    {
      return <input type="checkbox"  onChange={this.handleSelectOffer} value={data.id} />

    }
  }
  handleEditProposal(e){
    e.preventDefault();
    const isValid = this.validateproposal();
    //console.log(isValid);
    if(isValid === false){

    }
    else{
          axios.post('/wealththaiinsurance/update/proposal',{
          proposalid:this.state.proposalid,
          proposalname:this.state.proposalname,
          partnerblockid:this.state.partnerblockid,
          description:this.state.description,
          caseid:this.state.caseid2,

        }).then(res=>{
          this.setState({
            proposal:res.data,
            successmessage:'เปลี่ยนแปลงข้อมูลเรียบร้อยแล้ว',

          })
        });

      }
  }
  showeditform()
  {

      return <div class="content">
      <form onSubmit={this.handleEditProposal}>

      <table class="table  table-hover" >
      <tr>
      <th width=""><p>ชื่อ</p></th>
      <th ><input class="form-control"
      onChange={this.handleChangeProposalname}
      value={this.state.proposalname}
      /><br/><span style={{color:'red',fontSize:'12px'}}>{this.state.proposalnameError}</span></th>
      </tr>
      <tr>
      <th width=""><p></p></th>
      <th ></th>
      </tr>
      <tr>
      <th width=""><p>ผู้ให้คำปรึกษา/Partner</p></th>
      <th style={{width:'200px'}}>
       <Picky
        value={this.state.partnerblockname}
        options={this.state.partnerblock}
        onChange={this.handleChangePartnerblock}
        //open={true}
        valueKey="id"
        labelKey="name"
        //includeSelectAll={true}
        includeFilter={true}
        dropdownHeight={200}
        placeholder="โปรดเลือก"
        numberDisplayed ={1}
        filterPlaceholder=""
        tabIndex={104}
        filterPlaceholder=""
                       /></th>
      </tr>
      <tr>
      <th width=""><p></p></th>
      <th ></th>
      </tr>
      <tr>
      <th width=""><p>รายละเอียดเพิ่มเติม</p></th>
      <th ><textarea class="form-control"
      onChange={this.handleChangeProposaldescription}
      value={this.state.description}
      ></textarea></th>
      </tr>

      </table>
      <button class="btn btn-success btn-margin" type="submit">บันทึก</button>
      <button class="btn btn-danger btn-margin"  data-dismiss="modal">ออก</button>

      </form>
      </div>
  }
  showcase(data){
    if(data.cases === null || data.cases === '')
    {
      return <p></p>
    }
    else
    {
      return <p>{data.cases.name}</p>
    }
  }
  showpartnerproposal(data){
    if(data.partner_block === null || data.partner_block === '')
    {
      return <p></p>
    }
    else
    {
      return <p>{data.partner_block.name}</p>
    }
  }
  clickoffer(data)
  {
    this.state.clickedoffer = this.state.alloffer.find((alloffer) => {
     return alloffer.id == data.id
   })
   this.setState({oldprice:this.state.clickedoffer.offer_payment_value1
                  ,specialresult:this.state.clickedoffer.offer_payment_value1 - this.state.clickedoffer.offer_payment_value14,discountresult:this.state.clickedoffer.offer_payment_value14})

                  axios.get('/wealththaiinsurance/load/promotion').then(response=>{
                    this.setState({promotion:response.data});
                      //console.log('promotion');
                  }).catch(errors=>{
                    //console.log(errors);
                  })
                  this.state.netpremiumpromotion = this.state.allpremium;
  }
  editCliente(data) {
    this.state.flagopeneditprop = 1;
    this.setState({proposalname:data.name,
                   partnerblockid:data.partner_block.id,
                   partnerblockname:data.partner_block.name,
                   description:data.description,
                   proposalid:data.id,
                   successmessage:''
                 });
}
validateproposal(){
  let proposalnameError ='';
if(this.state.proposalname === null || this.state.proposalname === '' || this.state.proposalname === ' '){
    proposalnameError ="กรุณาตั้งชื่อ";
  }


  if(proposalnameError){
    this.setState({
      proposalnameError
    });
    return false;
  }
  return true;
}
addproposal()
{
  this.setState({flagaddproposal:1});
  //console.log(this.state.flagaddproposal);
}
handleSubmitProposal(e){
  e.preventDefault();
  const isValid = this.validateproposal();
  //console.log(isValid);
  if(isValid === false){

  }
  else{
        axios.post('/wealththaiinsurance/store/proposal',{
        proposalname:this.state.proposalname,
        partnerblockid:this.state.partnerblockid,
        description:this.state.description,
        caseid:this.state.caseid2,

      }).then(res=>{

        this.setState({
          proposal:res.data,
          successmessage:'เพิ่มข้อมูลเรียบร้อยแล้ว',
          proposalname:'',
          partnerblockname:'',
          partnerblockid:'',
          description:'',
        })
      });

    }
}
validateproposal(){
  let proposalnameError ='';
if(this.state.proposalname === null || this.state.proposalname === '' || this.state.proposalname === ' '){
    proposalnameError ="กรุณาตั้งชื่อ";
  }


  if(proposalnameError){
    this.setState({
      proposalnameError
    });
    return false;
  }
  return true;
}
onClickProposal(data){

  //console.log("first",this.state.offer);
  let proposalclickoffer = this.state.offer.filter((alloffer) => {
    return alloffer.proposal_id == data.id
  })
  this.setState({
    alloffer:proposalclickoffer,
  })
  //console.log("last",proposalclickoffer);
}
  openclassicview()
  {

    this.setState({
      classicviewflag: 1
    });
  }
  closeclassicview()
  {
    this.setState({
      classicviewflag: 0
    });
  }
  totaluserpayment(data)
  {
    let ans = data.offer_payment_value4;
    return <span>{ans}</span>
  }
  classicview()
  {
    if(this.state.classicviewflag == 1)
    {
      return <div>{this.alertwhensave()}
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
        <tr role="row">
        <th  colspan="100"><a href={"/wealththaiinsurance/offeruser/create?prev/wealththaiinsurance/cases/"+this.state.caseid2+"/offer/show?blink/wealththaiinsurance/cases/"+this.state.caseid2+"/detail/show?page=offer"+this.state.caseid2}  class="btn btn-success btn-margin">เพิ่มข้อเสนอ</a> <a  href={"/wealththaiinsurance/cases/quotation/"+this.state.caseid2} target="_blank" class="btn btn-info btn-margin">ใบเสนอราคา</a><a  href={"/wealththaiinsurance/cases/quotationcustomer/"+this.state.caseid2} target="_blank" class="btn btn-info btn-margin">ใบเสนอราคาสำหรับลูกค้า</a>
        <a  href={"/wealththaiinsurance/cases/consolidatequotation/"+this.state.caseid2} target="_blank" class="btn btn-info btn-margin">ใบเสนอราคา(แบ่งตามบริษัทประกัน)</a><a  href={"/wealththaiinsurance/cases/consolidatequotationcustomer/"+this.state.caseid2} target="_blank" class="btn btn-info btn-margin">ใบเสนอราคาสำหรับลูกค้า(่แบ่งตามบริษัทประกัน)</a> <a  onClick={this.SeeallOffer} class="btn btn-default btn-margin">ดูข้อเสนอทั้งหมด</a></th>
        </tr>
        <tr role="row">
          <th  colspan="10"  > </th>
          <th  colspan="5"  style={{textAlign:'center',backgroundColor:"silver"}}>ทุนประกัน	 </th>
          <th  colspan="30"  style={{textAlign:'center',backgroundColor:"silver"}}>รายละเอียด</th>
          </tr>
          <tr role="row">
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">เลือกรายการ(confirm) </th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending"></th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">AI </th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Interest</th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ชื่อข้อเสนอ </th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">โปรโมชั่น</th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">แคมเปญ</th>
          <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ประเภทข้อเสนอ</th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">บริษัท</th>
          <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">สาขา</th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename5}</th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename6}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename7}  </th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename1}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename14}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename19}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename2}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename3}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename4}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename8}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename9}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename10}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename11}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename12}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename13}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename14}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename15}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ต{this.props.offervaluename16}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename17}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename18}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offerpaymentvaluename4}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offerpaymentvaluename5}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ส่วนลดพิเศษทั้งหมด</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย (Customer)</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย (Customer)</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท (User)</th>


          </tr>
        </thead>
        <tbody>
        {this.state.alloffer.map(data =>
        <tr  role="row" class="odd">
          <th style={{textAlign:'center'}}>{this.showcheckbox(data)}</th>
          <th><a class="btn btn-warning btn-margin" href={'/wealththaiinsurance/offeruser/'+data.id+'/edit?prev/wealththaiinsurance/casesuser/'+this.state.caseid2+'/offer/show?blink/wealththaiinsurance/cases/'+this.state.caseid2+'/detail/showuser'}>แก้ไข</a></th>
              <th></th>
              <th style={{textAlign:'center'}}>{this.checkboxinterest(data)}</th>
              <th >{data.name}</th>
              <th>{this.promotion(data)}</th>
              <th>{this.campaign(data)}</th>
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
              <th >{data.offer_value8}</th>
              <th >{data.offer_value9}</th>
              <th >{data.offer_value10}</th>
              <th >{data.offer_value11}</th>
              <th >{data.offer_value12}</th>
              <th >{data.offer_value13}</th>
              <th >{data.offer_value14}</th>
              <th >{data.offer_value15}</th>
              <th >{data.offer_value16}</th>
              <th >{data.offer_value17}</th>
              <th >{data.offer_value18}</th>
              <th >{data.offer_payment_value4} บาท</th>
              <th >{data.offer_payment_value5} บาท</th>
              <th >{this.calculateallduscount(data)} บาท</th>
              <th >{this.calculateBeforewithholding(data)} บาท</th>
              <th >{this.calculateAfterwithholding(data)} บาท</th>
              <th >{this.totalpaiduser(data)} บาท</th>
            </tr>
          )}
            </tbody>


      </table><button class="btn btn-success btn-margin" onClick={this.submitconfirmoffer}>บันทึก</button></div>
    }
    else
    {

      return <div>{this.alertwhensave()}
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
        <tr role="row">
        <th  colspan="100"><a href={"/wealththaiinsurance/offeruser/create?prev/wealththaiinsurance/cases/"+this.state.caseid2+"/offer/show?blink/wealththaiinsurance/cases/"+this.state.caseid2+"/detail/show?page=offer"+this.state.caseid2}  class="btn btn-success btn-margin">เพิ่มข้อเสนอ</a> <a  href={"/wealththaiinsurance/cases/quotation/"+this.state.caseid2} target="_blank" class="btn btn-info btn-margin">ใบเสนอราคา</a><a  href={"/wealththaiinsurance/cases/quotationcustomer/"+this.state.caseid2} target="_blank" class="btn btn-info btn-margin">ใบเสนอราคาสำหรับลูกค้า</a>
        <a  href={"/wealththaiinsurance/cases/consolidatequotation/"+this.state.caseid2} target="_blank" class="btn btn-info btn-margin">ใบเสนอราคา(แบ่งตามบริษัทประกัน)</a><a  href={"/wealththaiinsurance/cases/consolidatequotationcustomer/"+this.state.caseid2} target="_blank" class="btn btn-info btn-margin">ใบเสนอราคาสำหรับลูกค้า(่แบ่งตามบริษัทประกัน)</a> <a  onClick={this.SeeallOffer} class="btn btn-default btn-margin">ดูข้อเสนอทั้งหมด</a></th>
        </tr>
          <tr role="row">
          <th  colspan="11"  > </th>
          <th  colspan="5"  style={{textAlign:'center',backgroundColor:"silver"}}>ทุนประกัน	 </th>
          <th  colspan="4"  style={{textAlign:'center',backgroundColor:"silver"}}>ความเสียหายต่อทรัพย์สิน</th>
          </tr>
          <tr role="row">
          <th style={{width:'10px'}}  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">เลือก</th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">AI </th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Interest</th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ชื่อข้อเสนอ </th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">โปรโมชั่น</th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">แคมเปญ</th>
          <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ประเภทข้อเสนอ</th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">บริษัท</th>
          <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">สาขา</th>
          <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offerpaymentvaluename4}</th>
          <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">เบี้ยสำหรับ<br/>ผู้แจ้งงาน</th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename5}</th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename6}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename7}  </th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename1}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename14}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename19}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename2}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename3}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">{this.props.offervaluename4}</th>
          <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending"></th>

          </tr>
        </thead>
        <tbody>
        {this.state.alloffer.map(data =>
        <tr  role="row" class="odd">
          <th style={{textAlign:'center'}}>{this.showcheckbox(data)}</th>
              <th></th>
              <th style={{textAlign:'center'}}>{this.checkboxinterest(data)}</th>
              <th >{data.name}</th>
              <th>{this.promotion(data)}</th>
              <th>{this.campaign(data)}</th>
              <th>{data.offer_type.name}</th>
              <th>{data.person.name}</th>
              {this.showbranchname(data)}
              <th>{data.offer_payment_value4}</th>
              <th>{this.totalpaiduser(data)}</th>
              <th>{data.offer_value5}</th>
              <th>{data.offer_value6}</th>
              <th>{data.offer_value7}</th>
              <th>{data.offer_value1}</th>
              <th>{data.offer_value14}</th>
              <th>{data.offer_value19}</th>
              <th>{data.offer_value2}</th>
              <th>{data.offer_value3}</th>
              <th>{data.offer_value4}</th>

              <th><a class="btn btn-warning btn-margin" href={'/wealththaiinsurance/offeruser/'+data.id+'/edit?prev/wealththaiinsurance/casesuser/'+this.state.caseid2+'/offer/show?blink/wealththaiinsurance/cases/'+this.state.caseid2+'/detail/showuser'}>แก้ไข</a>
              <button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target={"#myModal"+data.id} onClick={this.clickoffer.bind(this,data)}>รายละเอียด</button>
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
                    <th width=""><p>{this.props.offerpaymentvaluename4}</p></th>
                    <th >{data.offer_payment_value4} บาท</th>
                    </tr>
                    <tr>
                    <th width=""><p>{this.props.offerpaymentvaluename5}</p></th>
                    <th >{data.offer_payment_value5} บาท</th>
                    </tr>
                    <tr>
                    <th width=""><p>ส่วนลดพิเศษทั้งหมด </p></th>
                    <th >{this.calculateallduscount(data)} บาท</th>
                    </tr>
                    <tr>
                    <th width=""><p>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</p></th>
                    <th >{this.calculateBeforewithholding(data)} บาท</th>
                    </tr>
                    <tr>
                    <th width=""><p>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</p></th>
                    <th >{this.calculateAfterwithholding(data)} บาท</th>
                    </tr>

                    <tr>
                    <th width=""><p>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User)</p></th>
                    <th >{this.totalpaiduser(data)} บาท</th>
                    </tr>

                    </table>
                    </div>
                    <div id={"menu2"+data.id} class="tab-pane " style={{overflowX:'auto'}}>
                    <br/>
                    <div class="" >
                    <div class="column2fordis">

                    <label for="username" class="col-md-4 control-label">เบี้ยสุทธิ</label>
                    <div class="col-md-7">
                    {this.netpremium(data)}

                    </div>
                    <label for="username" class="col-md-4 control-label">&nbsp;</label>
                    <div class="col-md-6">
                    &nbsp;
                    </div>
                    </div>
                    <div class="column2fordis">

                    <label for="username" class="col-md-4 control-label">{this.props.offerpaymentvaluename4}</label>
                    <div class="col-md-7">
                    {this.allpremium(data)}

                    </div>
                    <label for="username" class="col-md-4 control-label">&nbsp;</label>
                    <div class="col-md-6">
                    &nbsp;
                    </div>
                    </div>
                    <div class="column2fordis">
                    <label for="username" class="col-md-4 control-label">ส่วนลดพิเศษ Promotion</label>
                    <div class="col-md-7">
                    {this.discountfrompromotion(data)}
                    </div>
                    <label for="username" class="col-md-4 control-label">&nbsp;</label>
                    <div class="col-md-6">
                    &nbsp;
                    </div>
                    </div>

                    <div class="column2fordis">
                    <label for="username" class="col-md-4 control-label">ส่วนลดพิเศษจาก LV ลูกค้า</label>
                    <div class="col-md-7">
                    {this.discountfromcustomerlevel(data)}
                    </div>
                    <label for="username" class="col-md-4 control-label">&nbsp;</label>
                    <div class="col-md-6">
                    &nbsp;
                    </div>
                    </div>

                    <div class="column2fordis">

                    <label for="username" class="col-md-4 control-label">&nbsp;</label>
                    <div class="col-md-6">
                    &nbsp;
                    </div>
                    </div>
                    <div class="column2fordis">
                    <label for="username" class="col-md-4 control-label">ส่วนลดพิเศษจาก User</label>
                    <div class="col-md-7">
                    {this.discountfromuserlevel(data)}
                    </div>
                    <label for="username" class="col-md-4 control-label">&nbsp;</label>
                    <div class="col-md-6">
                    &nbsp;
                    </div>
                    </div>
                    <div class="column2fordis">
                    <label for="username" class="col-md-4 control-label">ค่า Service Fee User</label>
                    <div class="col-md-7">
                    {this.servicefeeuser(data)}
                    </div>
                    <label for="username" class="col-md-4 control-label">&nbsp;</label>
                    <div class="col-md-6">
                    &nbsp;
                    </div>
                    </div>
                    <div class="column2fordis">
                    <label for="username" class="col-md-4 control-label">ส่วนลดพิเศษจากบริษัท </label>
                    <div class="col-md-7">
                    {this.discountfromcompany(data)}
                    </div>
                    <label for="username" class="col-md-4 control-label">&nbsp;</label>
                    <div class="col-md-6">
                    &nbsp;
                    </div>
                    </div>
                    <div class="column2fordis">
                    <label for="username" class="col-md-4 control-label">สรุปส่วนลดลูกค้า</label>
                    <div class="col-md-7">
                    {this.concludiscount(data)}
                    </div>
                    <label for="username" class="col-md-4 control-label">&nbsp;</label>
                    <div class="col-md-6">
                    &nbsp;
                    </div>
                    </div>
                    <div class="column2fordis">
                    <label for="username" class="col-md-4 control-label">ส่วนลดจากบริษัท/ส่วนชดเชยจากบริษัท </label>
                    <div class="col-md-7">
                    {this.companymiss(data)}
                    </div>
                    <label for="username" class="col-md-4 control-label">&nbsp;</label>
                    <div class="col-md-6">
                    &nbsp;
                    </div>
                    </div>
                    </div>



                    <form onSubmit={this.handleSubmitdiscount}>

                    <table style={{width:'600px',margin:'auto'}} id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                    <thead>
                    <tr role="row">
                      <th >รูปแบบส่วนลด</th>
                      <th >จำนวน(บาท)</th>
                      <th >มูลค่าเบี้ยสุทธิคงเหลือ</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr style={{backgroundColor:'#FFFF92'}} role="row" class="odd">
                    <td>มูลค่าเบี้ยรวมก่อนลด</td>
                    <td></td>
                    <td style={{textAlign:'right'}}>{this.state.allpremium} บาท</td>
                    </tr>
                    <tr  role="row" class="odd">
                    <td>ส่วนลดพิเศษ Promotion </td>
                    <td style={{textAlign:'right',color:'red'}}>{this.state.promotionbath}</td>
                    <td style={{textAlign:'right'}}>{this.state.netpremiumpromotion} บาท</td>
                    </tr>
                    <tr  role="row" class="odd">
                    <td>ส่วนลดพิเศษจาก LV ลูกค้า </td>
                    <td style={{textAlign:'right',color:'red'}}>{this.state.discountcustomerlv}</td>
                    <td style={{textAlign:'right'}}>{this.state.netpremiumcustomerlv} บาท</td>
                    </tr>

                    <tr  role="row" class="odd">
                    <td>ส่วนลดพิเศษจาก User </td>
                    <td style={{textAlign:'right',color:'red'}}>{this.state.discountuserlv}</td>
                    <td style={{textAlign:'right'}}>{this.state.netpremiumuserlv} บาท</td>
                    </tr>
                    <tr  role="row" class="odd">
                    <td>ส่วนลดพิเศษจากบริษัท </td>
                    <td style={{textAlign:'right',color:'red'}}>{this.state.discountcompany}</td>
                    <td style={{textAlign:'right'}}>{this.state.netpremiumcompany} บาท</td>
                    </tr>
                    <tr  role="row" class="odd">
                    <td>ส่วนลดจากบริษัท/ส่วนชดเชยจากบริษัท</td>
                    <td style={{textAlign:'right',color:'red'}}>{this.state.companymiss}</td>
                    <td style={{textAlign:'right'}}>{this.state.netpremiumcompanymiss} บาท</td>
                    </tr>
                    <tr style={{backgroundColor:'#91FAAF'}} role="row" class="odd">
                    <td>มูลค่าเบี้ยรวมหลังลด	 </td>
                    <td></td>
                    <td style={{textAlign:'right'}}>{this.state.netpremiumcompanymiss} บาท</td>
                    </tr>

                    </tbody>
                    </table>
                    <div style={{textAlign:'right'}}>
                    <button class="btn btn-success " type="submit">บันทึก</button>
                    </div>

                    </form>



                    </div>

                    </div>
                    </div></div></div></th>



            </tr>
          )}
            </tbody>


      </table><button class="btn btn-success btn-margin" onClick={this.submitconfirmoffer}>บันทึก</button></div>
    }
  }
  handleChangeProposalname(e){
    //console.log(e.target.value);
    this.setState({
      proposalname:e.target.value,
    })
    if(this.state.proposalname !== ''){
      this.setState({
        proposalnameError:'',
      })    }
  }
  handleChangeProposaldescription(e){
    //console.log(e.target.value);
    this.setState({
      description:e.target.value,
    })
  }
  alertwhensave()
  {
    if(this.state.showalertmessage == 1)
    {
      setTimeout(() => {
        this.setState({
          showalertmessage: ''
        });
      }, 5000);
    return <div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>สำเร็จ!</strong> ระบบบันทึกข้อมูลเรียบร้อยแล้ว!
</div>
    }
  }
    showdetail()
    {
      return<div>
      <div style={{overflowX:'auto'}}>
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
        <tr role="row">

        <th  colspan="100"  > <a class="btn btn-primary btn-margin" href={this.state.blink}>กลับ</a> <button type="button" class="btn btn-primary btn-margin" onClick={this.resetsuccesstext} data-toggle="modal" data-target="#myModal">Add Proposal</button><div class="modal " id="myModal" role="dialog">
          <div class="modal-dialog modal-lg " ><div class="modal-content">
          <div class="modal-header" >Add New Proposal                      <span setTimeout="2000" style={{color:'green',fontSize:'14px',textAlign:'center'}}>{this.state.successmessage}</span>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div><div class="tab-content" style={{padding:'10px'}}>
              <div class="content">
              <form onSubmit={this.handleSubmitProposal}>

              <table class="table  table-hover" >
              <tr >
              <th width=""><p>ชื่อ</p></th>
              <th ><input class="form-control"
              onChange={this.handleChangeProposalname}
              value={this.state.proposalname}
              /><br/><span style={{color:'red',fontSize:'12px'}}>{this.state.proposalnameError}</span></th>
              </tr>
              <tr>
              <th width=""><p></p></th>
              <th ></th>
              </tr>
              <tr>
              <th width=""><p>ผู้ให้คำปรึกษา/Partner</p></th>
              <th style={{width:'200px'}}>        <Picky
                value={this.state.partnerblockname}
                options={this.state.partnerblock}
                onChange={this.handleChangePartnerblock}
                //open={true}
                valueKey="id"
                labelKey="name"
                //includeSelectAll={true}
                includeFilter={true}
                dropdownHeight={200}
                placeholder="โปรดเลือก"
                numberDisplayed ={1}
                filterPlaceholder=""
                tabIndex={104}
                filterPlaceholder=""
                               /></th>
              </tr>
              <tr>
              <th width=""><p></p></th>
              <th ></th>
              </tr>
              <tr>
              <th width=""><p>รายละเอียดเพิ่มเติม</p></th>
              <th ><textarea class="form-control"
              onChange={this.handleChangeProposaldescription}
              value={this.state.description}
              ></textarea></th>
              </tr>

              </table>
              <button class="btn btn-success btn-margin" type="submit">บันทึก</button>
              <button class="btn btn-danger btn-margin"  data-dismiss="modal">ออก</button>

              </form>
              </div>

  </div>
  </div>
  </div>
  </div>

  </th>


        </tr>

          <tr role="row">
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ชื่อ </th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">สร้างโดย </th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">สร้างวันที่ </th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ผู้ให้คำปรึกษา </th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ชื่องาน </th>
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">รายละเอียดเพิ่มเติม </th>
            <th  tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending"></th>
          </tr>
        </thead>
        <tbody>
        {this.state.proposal.map(data =>
        <tr role="row" class="odd" onClick={this.onClickProposal.bind(this, data)}>
              <th >{data.name}</th>
              <th>{data.match_id.public_name}</th>
              <th>{data.created_date}</th>
              <th>{this.showpartnerproposal(data)}</th>
              <th>{this.showcase(data)}</th>
              <th>{data.description}</th>
              <th><button class="btn btn-warning btn-margin"onClick={this.editCliente.bind(this, data)} data-toggle="modal" data-target="#myModal2">แก้ไข</button>
              <div class="modal " id="myModal2" role="dialog"><div class="modal-dialog modal-lg " ><div class="modal-content">
             <div class="modal-header" >Add New Proposal                      <span setTimeout="2000" style={{color:'green',fontSize:'14px',textAlign:'center'}}>{this.state.successmessage}</span>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div><div class="tab-content" style={{padding:'10px'}}>

             {this.showeditform()}

         </div>
         </div>
         </div>
         </div>
              </th>
            </tr>
  )}
            </tbody>

  </table></div>
  <div style={{overflowX:'auto'}}>
  <button class="btn btn-default btn-margin" onClick={this.openclassicview}>Classic View</button><button class="btn btn-default btn-margin" onClick={this.closeclassicview}>Modern View</button>
  {this.classicview()}
   </div></div>
 }
    render() {
      return (
            <div>
            {this.showdetail()}
            </div>
        );
    }
}
if (document.getElementById('insuranceshowofferuser')) {
    const component = document.getElementById('insuranceshowofferuser');
    const props = Object.assign({}, component.dataset);
      ReactDOM.render(<InsuranceShowofferuser {...props}/>, component);
}

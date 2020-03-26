import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import ReactTable from 'react-table'
import 'react-table/react-table.css'
import Dialog from 'react-dialog'
import Picky from 'react-picky';
import 'react-picky/dist/picky.css'; // Include CSS
import Modal from 'react-awesome-modal';
import RTChart from 'react-rt-chart';
import Select from 'react-select';
import ReactHTMLTableToExcel from 'react-html-table-to-excel';
import jsPDF from "jspdf";

export default class CasePayment extends Component {

  constructor(){
    super();
    ////console.log(super());
    this.state = {
      fixpaymentdetailflag:0,
      casepaymentcolumn:0,
      showall:'box collapsed-box',
      varvalue28:'',
      varvalue29:'',
      varvalue26:'',
      varvalue27:'',
      varvalue30:'',
      varvalue31:'',
      varvalue32:'',
      varvalue33:'',
      varvalue34:'',

      varvalue5:'',
      varvalue6:'',
      varvalue7:'',
      varvalue17:'',
      varvalue18:'',
      varvalue19:'',
      varvalue51:'',
      varvalue52:'',
      varvalue53:'',
      day:[],
      month:[],
      year:[],
      varvalue5day:'',varvalue5month:'',varvalue5year:'',varvalue6day:'',varvalue6month:'',varvalue6year:'',
      varvalue7day:'',varvalue7month:'',varvalue7year:'',varvalue17day:'',varvalue17month:'',varvalue17year:'',varvalue18day:'',varvalue18month:'',varvalue18year:'',
      varvalue19day:'',varvalue19month:'',varvalue19year:'',varvalue51day:'',varvalue51month:'',varvalue51year:'',
      varvalue52day:'',varvalue52month:'',varvalue52year:'',varvalue53day:'',varvalue53month:'',varvalue53year:'',
    };
    this.openfixpaymentdetail= this.openfixpaymentdetail.bind(this);
    this.closefixpaymentdetail= this.closefixpaymentdetail.bind(this);
    this.columnchangecasepayment= this.columnchangecasepayment.bind(this);
    this.columnchangecasepaymentdefault= this.columnchangecasepaymentdefault.bind(this);
    this.submitcasepayment= this.submitcasepayment.bind(this);

  }
  componentDidMount() {
    console.log(this.props.varname5)
    const url = window.location.href;
    this.setState({varvalue5:this.props.varvalue5,
                   varvalue6:this.props.varvalue6,
                   varvalue7:this.props.varvalue7,
                   varvalue17:this.props.varvalue17,
                   varvalue18:this.props.varvalue18,
                   varvalue19:this.props.varvalue19,
                   varvalue51:this.props.varvalue51,
                   varvalue52:this.props.varvalue52,
                   varvalue53:this.props.varvalue53,
                   varvalue28:this.props.varvalue28,
                   varvalue29:this.props.varvalue29,
                   varvalue26:this.props.varvalue26,
                   varvalue27:this.props.varvalue27,
                   varvalue30:this.props.varvalue30,
                   varvalue31:this.props.varvalue31,
                   varvalue32:this.props.varvalue32,
                   varvalue33:this.props.varvalue33,
                   varvalue34:this.props.varvalue34,
                 });
    if(url.includes('?mode=open') == true)
    {
        this.setState({casepaymentcolumn:1});
    }
    else
    {
      this.setState({casepaymentcolumn:0});
    }
    axios.get('/wealththaiinsurance/load/day').then(response=>{
      this.setState({day:response.data});
    })
    axios.get('/wealththaiinsurance/load/month').then(response=>{
      this.setState({month:response.data});
    })
    axios.get('/wealththaiinsurance/load/year').then(response=>{
      this.setState({year:response.data});
    })
  }
  submitcasepayment(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/casepayment',{
      id:this.props.id,
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
      varvalue5:this.state.varvalue5day+'/'+this.state.varvalue5month+'/'+this.state.varvalue5year,
      varvalue6:this.state.varvalue6day+'/'+this.state.varvalue6month+'/'+this.state.varvalue6year,
      varvalue7:this.state.varvalue7day+'/'+this.state.varvalue7month+'/'+this.state.varvalue7year,
      varvalue17:this.state.varvalue17day+'/'+this.state.varvalue17month+'/'+this.state.varvalue17year,
      varvalue18:this.state.varvalue18day+'/'+this.state.varvalue18month+'/'+this.state.varvalue18year,
      varvalue19:this.state.varvalue19day+'/'+this.state.varvalue19month+'/'+this.state.varvalue19year,
      varvalue52:this.state.varvalue52day+'/'+this.state.varvalue52month+'/'+this.state.varvalue52year,
      varvalue51:this.state.varvalue51day+'/'+this.state.varvalue51month+'/'+this.state.varvalue51year,
      varvalue53:this.state.varvalue53day+'/'+this.state.varvalue53month+'/'+this.state.varvalue53year,


    }).then(res=>{

      //console.log(res.data);
      this.setState({
        fixpaymentdetailflag:0,
      })
      window.location.reload();
    });
  }
  insurancepaymentcopy()
  {
    if(this.props.insurancecopypaymentfilepublicname == null || this.props.insurancecopypaymentfilepublicname == '' ||this.props.insurancecopypaymentfilepublicname == 'undefined')
    {
      if(this.props.varvalue35 == null ||this.props.varvalue35 == '' )
      {
        return  <th style={{backgroundColor:'white'}}><span style={{fontSize:'12px',color:'red'}}>ต้องเลือกวิธีชำระเงินกรมธรรม์ก่อน</span><br/><a disabled class="btn btn-default">อัพโหลด</a></th>
      }
      else
      {
        return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+this.props.id+"/xxx/CG4CG/Case_Attachment?cat?CA50CA/blink/wealththaiinsurance/cases/"+this.props.id+"/detail/showblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
      }
    }
    else
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={'/SecurityBroke/showfile/' +this.props.insurancecopypaymentfileid} target="_blank">{this.props.insurancecopypaymentfilepublicname}</a></th>
    }
  }
  insurancepaymentcopytocompany()
  {
    if(this.props.insurancepaymenttocompanycopyfilepublicname == null || this.props.insurancepaymenttocompanycopyfilepublicname == '' ||this.props.insurancepaymenttocompanycopyfilepublicname == 'undefined')
    {
      if(this.props.varvalue8 == null ||this.props.varvalue8 == '' )
      {
        return  <th style={{backgroundColor:'white'}}><span style={{fontSize:'12px',color:'red'}}>ระบุวันที่บริษัทนำส่งเบี้ยกรมธรรม์ให้ก่อน</span><br/><a disabled class="btn btn-default">อัพโหลด</a></th>

      }
      else
      {
        return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+this.props.id+"/xxx/CG4CG/Case_Attachment?cat?CA54CA/blink/wealththaiinsurance/cases/"+this.props.id+"/detail/showblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>

      }


   }
    else
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={'/SecurityBroke/showfile/' +this.props.insurancepaymenttocompanycopyfileid} target="_blank">{this.props.insurancepaymenttocompanycopyfilepublicname}</a></th>
    }
  }
  actpaymentcopy()
  {
    if(this.props.actcopypaymentfilepublicname == null || this.props.actcopypaymentfilepublicname == '' ||this.props.actcopypaymentfilepublicname == 'undefined')
    {
      if(this.props.varvalue36 == null ||this.props.varvalue36 == '' )
      {
        return  <th style={{backgroundColor:'white'}}><span style={{fontSize:'12px',color:'red'}}>ระบุวันที่บริษัทนำส่งเบี้ยกรมธรรม์ให้ก่อน</span><br/><a disabled class="btn btn-default">อัพโหลด</a></th>
      }
      else
      {
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+this.props.id+"/xxx/CG4CG/Case_Attachment?cat?CA51CA/blink/wealththaiinsurance/cases/"+this.props.id+"/detail/showblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>

      }
    }
    else
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={'/SecurityBroke/showfile/' +this.props.actcopypaymentfileid} target="_blank">{this.props.actcopypaymentfilepublicname}</a></th>
    }
  }
  actpaymentcopytocompany()
  {
    if(this.props.actpaymenttocompanycopyfilepublicname == null || this.props.actpaymenttocompanycopyfilepublicname == '' ||this.props.actpaymenttocompanycopyfilepublicname == 'undefined')
    {
      if(this.props.varvalue9 == null ||this.props.varvalue9 == '' )
      {
        return  <th style={{backgroundColor:'white'}}><span style={{fontSize:'12px',color:'red'}}>ระบุวันที่บริษัทนำส่งเบี้ยพรบให้ก่อน</span><br/><a disabled class="btn btn-default">อัพโหลด</a></th>

      }
      else
      {
        return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+this.props.id+"/xxx/CG4CG/Case_Attachment?cat?CA55CA/blink/wealththaiinsurance/cases/"+this.props.id+"/detail/showblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
      }
    }
    else
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={'/SecurityBroke/showfile/' +this.props.actpaymenttocompanycopyfileid} target="_blank">{this.props.actpaymenttocompanycopyfilepublicname}</a></th>
    }
  }
  taxpaymentcopy()
  {
    if(this.props.taxcopypaymentfilepublicname == null || this.props.taxcopypaymentfilepublicname == '' ||this.props.taxcopypaymentfilepublicname == 'undefined')
    {
      if(this.props.varvalue37 == null ||this.props.varvalue37 == '' )
      {
      return  <th style={{backgroundColor:'white'}}><span style={{fontSize:'12px',color:'red'}}>ต้องเลือกวิธีชำระเงินภาษีก่อน</span><a disabled class="btn btn-default">อัพโหลด</a></th>
      }
      else
      {
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+this.props.id+"/xxx/CG4CG/Case_Attachment?cat?CA52CA/blink/wealththaiinsurance/cases/"+this.props.id+"/detail/showblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
      }
    }
    else
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={'/SecurityBroke/showfile/' +this.props.taxcopypaymentfileid} target="_blank">{this.props.taxcopypaymentfilepublicname}</a></th>
    }
  }
  taxpaymentcopytocompany()
  {
    if(this.props.taxpaymenttocompanycopyfilepublicname == null || this.props.taxpaymenttocompanycopyfilepublicname == '' ||this.props.taxpaymenttocompanycopyfilepublicname == 'undefined')
    {
      if(this.props.varvalue10 == null ||this.props.varvalue10 == '' )
      {
        return  <th style={{backgroundColor:'white'}}><span style={{fontSize:'12px',color:'red'}}>ระบุวันที่บริษัทนำส่งเบี้ยภาษีให้ก่อน</span><a disabled class="btn btn-default">อัพโหลด</a></th>
      }
      else
      {
        return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+this.props.id+"/xxx/CG4CG/Case_Attachment?cat?CA56CA/blink/wealththaiinsurance/cases/"+this.props.id+"/detail/showblink"} target="_blank" class="btn btn-default">อัพโหลด</a></th>
      }
    }
    else
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={'/SecurityBroke/showfile/' +this.props.taxpaymenttocompanycopyfileid} target="_blank">{this.props.taxpaymenttocompanycopyfilepublicname}</a></th>
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
  openfixpaymentdetail()
  {
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
  detailorfix()
  {
    if(this.state.fixpaymentdetailflag == 0)
    {
        if(this.state.varvalue5 == null ||this.state.varvalue5 == 'undefined'){this.state.varvalue5  = "///"}if(this.state.varvalue6 == null ||this.state.varvalue6 == 'undefined'){this.state.varvalue6 = "///"}if(this.state.varvalue7 == null ||this.state.varvalue7 == 'undefined'){this.state.varvalue7 = "///"}if(this.state.varvalue8 == null ||this.state.varvalue8 == 'undefined'){this.state.varvalue8 = "///"}
        if(this.state.varvalue17 == null ||this.state.varvalue17 == 'undefined'){this.state.varvalue17 = "///"}if(this.state.varvalue18 == null ||this.state.varvalue18 == 'undefined'){this.state.varvalue18 = "///"}if(this.state.varvalue19 == null ||this.state.varvalue19 == 'undefined'){this.state.varvalue19 = "///"}
        if(this.state.varvalue51 == null ||this.state.varvalue51 == 'undefined'){this.state.varvalue51 = "///"}if(this.state.varvalue52 == null ||this.state.varvalue52 == 'undefined'){this.state.varvalue52 = "///"}if(this.state.varvalue53 == null ||this.state.varvalue53 == 'undefined'){this.state.varvalue53 = "///"}
        const var5 = this.state.varvalue5.split('/');this.state.varvalue5day = var5[0];this.state.varvalue5month = var5[1];this.state.varvalue5year = var5[2];
        const var6 = this.state.varvalue6.split('/');this.state.varvalue6day = var6[0];this.state.varvalue6month = var6[1];this.state.varvalue6year = var6[2];
        const var7 = this.state.varvalue7.split('/');this.state.varvalue7day = var7[0];this.state.varvalue7month = var7[1];this.state.varvalue7year = var7[2];
        const var17 = this.state.varvalue17.split('/');this.state.varvalue17day = var17[0];this.state.varvalue17month = var17[1];this.state.varvalue17year = var17[2];
        const var18 = this.state.varvalue18.split('/');this.state.varvalue18day = var18[0];this.state.varvalue18month = var18[1];this.state.varvalue18year = var18[2];
        const var19 = this.state.varvalue19.split('/');this.state.varvalue19day = var19[0];this.state.varvalue19month = var19[1];this.state.varvalue19year = var19[2];
        const var51 = this.state.varvalue51.split('/');this.state.varvalue51day = var51[0];this.state.varvalue51month = var51[1];this.state.varvalue51year = var51[2];
        const var52 = this.state.varvalue52.split('/');this.state.varvalue52day = var52[0];this.state.varvalue52month = var52[1];this.state.varvalue52year = var52[2];
        const var53 = this.state.varvalue53.split('/');this.state.varvalue53day = var53[0];this.state.varvalue53month = var53[1];this.state.varvalue53year = var53[2];
    return <div className="column" id="paymentdetail" >
    <div className="box " style={{backgroundColor:'#CDCDCD'}}>
    <div className="box-header  ">
      <b className="box-title" >รายละเอียดการชำระเงิน</b>
      <br/>
      <br/>
      <div className="box-tools pull-right">
      <button type="button" onClick={this.openfixpaymentdetail} className="btn btn-box-tool" ><i style={{color:'orange'}} className="fa fa-gear"></i></button>
        <button type="button" onClick={this.columnchangecasepaymentdefault} className="btn btn-box-tool" ><i className="fa fa-minus"></i></button>
      </div>
    </div>
    <div className="box-body" >
    <div className="column4">
    <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th colSpan="2" style={{backgroundColor:'white',width:'200px',height:'',textAlign:'center',fontSize:'20px'}}>ข้อมูลกรมธรรม์</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>{this.props.varname28}</th>
     <th style={{backgroundColor:'white'}}>{this.props.varvalue28}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>{this.props.varname29}</th>
     <th style={{backgroundColor:'white'}}>{this.props.varvalue29}</th>
   </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}  >{this.props.varname26}</th>
      <th style={{backgroundColor:'white'}}>{this.props.varvalue26}</th>

    </tr>

    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>บริษััทประกันที่เลือก(ใหม่)กรมธรรม์</th>
     <th style={{backgroundColor:'white'}}>{this.props.insurancecompanyname}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>เบี้ยรวมหน้าตั๋ว</th>
     <th style={{backgroundColor:'white'}}>{this.props.insurancepremium}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</th>
     <th style={{backgroundColor:'white'}}>{this.props.insurancetaxdeduction}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ส่วนลดพิเศษทั้งหมด </th>
     <th style={{backgroundColor:'white'}}>{this.props.alldiscountinsurance}</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>{this.props.varname32}</th>
    <th style={{backgroundColor:'white'}}>{this.props.varvalue32}</th>
  </tr>
  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>{this.props.varname35}</th>
   <th style={{backgroundColor:'white'}}>{this.props.varvalue35}</th>
 </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{this.props.calculatebeforetaxdeductinsurance}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{this.props.calculateaftertaxdeductinsurance}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </th>
    <th style={{backgroundColor:'white'}}>{this.props.totalpaidpartnerinsurance}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User) *</th>
    <th style={{backgroundColor:'white'}}>{this.props.totalpaiduserinsurance}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company) *</th>
    <th style={{backgroundColor:'white'}}>{this.props.totalpaidcompanyinsurance}</th>
  </tr>
  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname5}</th>
   <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue5}</th>
 </tr>
  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>เอกสารชำระเงิน กรมธรรม์</th>
 {this.insurancepaymentcopy()}
 </tr>
 <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
<th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>เอกสารชำระเงินไปยังบริษัทประกัน</th>
{this.insurancepaymentcopytocompany()}
</tr>
<tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
<th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname17}</th>
 <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue17}</th>
</tr>
<tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
<th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname52}</th>
 <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue52}</th>
</tr>
    </thead>

    </table>
    </div>
    <div className="column4">
    <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th colSpan="2" style={{backgroundColor:'white',width:'200px',height:'',textAlign:'center',fontSize:'20px'}}>ข้อมูลพรบ.</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}></th>
    <th style={{backgroundColor:'white'}}></th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>{this.props.varname27}</th>
   <th style={{backgroundColor:'white'}}>{this.props.varvalue27}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>{this.props.varname30}</th>
     <th style={{backgroundColor:'white'}}>{this.props.varvalue30}</th>
   </tr>


    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>บริษััทประกันที่เลือก(ใหม่)พรบ</th>
     <th style={{backgroundColor:'white'}}>{this.props.actcompanyname}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>เบี้ยรวมหน้าตั๋ว</th>
     <th style={{backgroundColor:'white'}}>{this.props.actpremium}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</th>
     <th style={{backgroundColor:'white'}}>{this.props.acttaxdeduction}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ส่วนลดพิเศษทั้งหมด </th>
     <th style={{backgroundColor:'white'}}>{this.props.alldiscountact}</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>{this.props.varname33}</th>
    <th style={{backgroundColor:'white'}}>{this.props.varvalue33}</th>
  </tr>
  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>{this.props.varname36}</th>
   <th style={{backgroundColor:'white'}}>{this.props.varvalue36}</th>
 </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{this.props.calculatebeforetaxdeductact}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{this.props.calculateaftertaxdeductact}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </th>
    <th style={{backgroundColor:'white'}}>{this.props.totalpaidpartneract}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User) *</th>
    <th style={{backgroundColor:'white'}}>{this.props.totalpaiduseract}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company) *</th>
    <th style={{backgroundColor:'white'}}>{this.props.totalpaidcompanyact}</th>
  </tr>
  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname6}</th>
   <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue6}</th>
 </tr>
  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>เอกสารชำระเงิน พรบ.</th>
  {this.actpaymentcopy()}
 </tr>
 <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
<th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>เอกสารชำระเงินไปยังบริษัทประกัน</th>
  {this.actpaymentcopytocompany()}
</tr>
<tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
<th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname18}</th>
 <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue18}</th>
</tr>
<tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
<th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname51}</th>
 <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue51}</th>
</tr>
    </thead>

    </table>
    </div>
    <div className="column4">
    <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th colSpan="2" style={{backgroundColor:'white',width:'200px',height:'',textAlign:'center',fontSize:'20px'}}>ข้อมูลภาษี</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>&nbsp;</th>
   <th style={{backgroundColor:'white'}}>&nbsp;</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>&nbsp;</th>
   <th style={{backgroundColor:'white'}}>&nbsp;</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>{this.props.varname31}</th>
     <th style={{backgroundColor:'white'}}>{this.props.varvalue31}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>บริษััทประกันที่เลือก(ใหม่)ภาษี</th>
     <th style={{backgroundColor:'white'}}>{this.props.taxcompanyname}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>เบี้ยรวมหน้าตั๋ว</th>
     <th style={{backgroundColor:'white'}}>{this.props.taxpremium}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ยอดหัก ณ ที่จ่าย * (ถ้ามีค่า)</th>
     <th style={{backgroundColor:'white'}}>{this.props.taxtaxdeduction}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ส่วนลดพิเศษทั้งหมด </th>
     <th style={{backgroundColor:'white'}}>{this.props.alldiscounttax}</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>{this.props.varname34}</th>
    <th style={{backgroundColor:'white'}}>{this.props.varvalue34}</th>
  </tr>


  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>{this.props.varname37}</th>
   <th style={{backgroundColor:'white'}}>{this.props.varvalue37}</th>
 </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{this.props.calculatebeforetaxdeducttax}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย   (Customer)</th>
    <th style={{backgroundColor:'white'}}>{this.props.calculateaftertaxdeducttax}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </th>
    <th style={{backgroundColor:'white'}}>{this.props.totalpaidpartnertax}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User) *</th>
    <th style={{backgroundColor:'white'}}>{this.props.totalpaidusertax}</th>
  </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company) *</th>
    <th style={{backgroundColor:'white'}}>{this.props.totalpaidcompanytax}</th>
  </tr>
  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname7}</th>
   <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue7}</th>
 </tr>
  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
 <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>เอกสารชำระเงิน ภาษี</th>
 {this.taxpaymentcopy()}
 </tr>
 <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
<th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>เอกสารชำระเงินไปยังบริษัทประกัน</th>
{this.taxpaymentcopytocompany()}
</tr>
<tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
<th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname19}</th>
 <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue19}</th>
</tr>
<tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
<th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname53}</th>
 <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue53}</th>
</tr>
    </thead>

    </table>
    </div>
    <div className="column4">
    <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th colSpan="2" style={{backgroundColor:'#72EB00',width:'200px',height:'',textAlign:'center',fontSize:'20px'}}>รวม</th>
    </tr>
    <tr style={{border:'0.5px solid #F4F4F6',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>&nbsp;</th>
    <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
    <tr style={{border:'0.5px solid #F4F4F6',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>&nbsp;</th>
    <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
    <tr style={{border:'0.5px solid #F4F4F6',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>&nbsp;</th>
    <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
    <tr style={{border:'0.5px solid #F4F4F6',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>&nbsp;</th>
    <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'50%',height:'100px',textAlign:'center'}}>เบี้ยรวมหน้าตั๋ว(รวม)</th>
     <th style={{backgroundColor:'#72EB00'}}>{this.props.allpremium}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'50%',height:'100px',textAlign:'center'}}>ยอดหัก ณ ที่จ่าย * (รวม)</th>
     <th style={{backgroundColor:'#72EB00'}}>{this.props.alltaxdeduct}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'50%',height:'100px',textAlign:'center'}}>ส่วนลดพิเศษทั้งหมด (รวม) </th>
     <th style={{backgroundColor:'#72EB00'}}>{this.props.alldiscount}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>&nbsp;</th>
    <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'100px',textAlign:'center'}}>&nbsp;</th>
    <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายก่อนหัก ณ ที่จ่าย (Customer)</th>
    <th style={{backgroundColor:'#72EB00'}}>{this.props.allcalculatebeforetaxdeduct}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ลูกค้าต้องจ่ายหลังหัก ณ ที่จ่าย (Customer)</th>
    <th style={{backgroundColor:'#72EB00'}}>{this.props.allcalculateaftertaxdeduct}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ให้คำปรึกษา/แนะนำ ต้องจ่ายให้แก่บริษัท  (Partner) </th>
    <th style={{backgroundColor:'#72EB00'}}>{this.props.alltotalpaidpartner}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่ผู้ให้บริการ ต้องจ่ายให้แก่บริษัท  (User) *</th>
    <th style={{backgroundColor:'#72EB00'}}>{this.props.alltotalpaiduser}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#72EB00',width:'50%',height:'100px',textAlign:'center'}}>ค่าใช้จ่ายสุทธิที่บริษัทต้องโอนไปบริษัทประกัน (Company) *</th>
    <th style={{backgroundColor:'#72EB00'}}>{this.props.alltotalpaidcompany}</th>
    </tr>

    </thead>

    </table>
    </div>
    </div>
    </div>
    </div>
    }
    else
    {
      return <form onSubmit={this.submitcasepayment}>
      <div class="column" id="paymentdetail">
      <div class="box " style={{backgroundColor:'#FFE0BE'}}>
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
      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th colSpan="2" style={{backgroundColor:'white',width:'200px',height:'',textAlign:'center',fontSize:'20px'}}>ข้อมูลกรมธรรม์</th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{this.props.varname28}</th>
        <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue28: e.target.value })} value={this.state.varvalue28}/></th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}  >{this.props.varname26}</th>
       <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue26: e.target.value })} value={this.state.varvalue26}/></th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{this.props.varname29}</th>
       <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue29: e.target.value })} value={this.state.varvalue29}/></th>
     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{this.props.varname32}</th>
      <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue32: e.target.value })} value={this.state.varvalue32}/></th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{this.props.varname35}</th>
     <th style={{backgroundColor:'white'}}>
     <select onChange={(e) => this.setState({ varvalue35: e.target.value })} style={{width:'150px'}} class="form-control">
     <option value ="" selected={this.state.varvalue35 == null ? 'selected' : ''}>  กรุณาเลือก </option>
     <option value ="0" selected={this.state.varvalue35 == '0' ? 'selected' : ''}>  ตัด Net  </option>
     <option value ="1" selected={this.state.varvalue35 == '1' ? 'selected' : ''}>  รับคอมมิชชั่นทีหลัง  </option>
     </select>
     </th>
   </tr>

  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{this.props.varname5}</th>
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
<th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname17} </th>
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

<tr role="row" >
<th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname52}</th>
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
      </thead>

      </table>
      </div>
      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th colSpan="2" style={{backgroundColor:'white',width:'200px',height:'',textAlign:'center',fontSize:'20px'}}>ข้อมูลพรบ.</th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>&nbsp;</th>
       <th style={{backgroundColor:'white'}}></th>

     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{this.props.varname27}</th>
       <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue27: e.target.value })} value={this.state.varvalue27}/></th>
      </tr>

      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{this.props.varname30}</th>
       <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue30: e.target.value })} value={this.state.varvalue30}/></th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{this.props.varname33}</th>
        <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue33: e.target.value })} value={this.state.varvalue33}/></th>
      </tr>


       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{this.props.varname36}</th>
        <th style={{backgroundColor:'white'}}>
        <select onChange={(e) => this.setState({ varvalue36: e.target.value })} style={{width:'150px'}} class="form-control">
        <option value ="" selected={this.state.varvalue36 == null ? 'selected' : ''}>  กรุณาเลือก </option>
        <option value ="0" selected={this.state.varvalue36 == '0' ? 'selected' : ''}>  ตัด Net  </option>
        <option value ="1" selected={this.state.varvalue36 == '1' ? 'selected' : ''}>  รับคอมมิชชั่นทีหลัง  </option>
        </select>
        </th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname6} </th>
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
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname18} </th>
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
     <tr role="row" >
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname51}</th>
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
      </thead>

      </table>
      </div>
      <div class="column3">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th colSpan="2" style={{backgroundColor:'white',width:'200px',height:'',textAlign:'center',fontSize:'20px'}}>ข้อมูลภาษี</th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>&nbsp;</th>
       <th style={{backgroundColor:'white'}}></th>

     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>&nbsp;</th>
       <th style={{backgroundColor:'white'}}></th>

     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{this.props.varname31}</th>
       <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue31: e.target.value })} value={this.state.varvalue31}/></th>
     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{this.props.varname34}</th>
      <th style={{backgroundColor:'white'}}><input style={{width:'150px'}}class="form-control" onChange={(e) => this.setState({ varvalue34: e.target.value })} value={this.state.varvalue34}/></th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'200px',height:'60px'}}>{this.props.varname37}</th>
      <th style={{backgroundColor:'white'}}>
      <select onChange={(e) => this.setState({ varvalue37: e.target.value })} style={{width:'150px'}} class="form-control">
      <option value ="" selected={this.state.varvalue37 == null ? 'selected' : ''}>  กรุณาเลือก </option>
      <option value ="0" selected={this.state.varvalue37 == '0' ? 'selected' : ''}>  ตัด Net  </option>
      <option value ="1" selected={this.state.varvalue37 == '1' ? 'selected' : ''}>  รับคอมมิชชั่นทีหลัง  </option>
      </select>
      </th>

     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname7} </th>
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
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname19} </th>
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
     <tr role="row" >
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname53}</th>
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
      </thead>

      </table>
      </div>
      </div>
      </div>
      </div>
      </form>
    }
  }
  showdetail()
  {
    if(this.state.casepaymentcolumn === 0)
    {
    return <div className="column2" id="paymentdetail">
    <div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
    <div className="box-header  ">
      <b className="box-title" >รายละเอียดการชำระเงิน</b>
      <br/>
      <br/>
       <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
       <thead>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname28}</th>
        <th style={{backgroundColor:'white'}}>{this.props.varvalue28}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname51}</th>
        <th style={{backgroundColor:'white'}}>{this.props.varvalue51}</th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname52}</th>
       <th style={{backgroundColor:'white'}}>{this.props.varvalue52}</th>
     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname53}</th>
      <th style={{backgroundColor:'white'}}>{this.props.varvalue53}</th>
    </tr>
      </thead>
       </table>
      <div className="box-tools pull-right">
        <button type="button" onClick={this.columnchangecasepayment} className="btn btn-box-tool" ><i className="fa fa-plus"></i></button>
      </div>
    </div>

    </div>
    </div>
  }
    else
    {
      return <div>{this.detailorfix()}</div>
    }
  }
    render() {
      return (
        <div>{this.showdetail()}</div>
        );
    }
}

if (document.getElementById('casepayment')) {
  const component = document.getElementById('casepayment');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<CasePayment {...props}/>, component);
}

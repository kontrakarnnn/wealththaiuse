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

export default class CaseTracking extends Component {

  constructor(){
    super();
    ////console.log(super());
    this.state = {
      showall:'box collapsed-box',
      stage:'',
      status:'',
      casetrackingcolumn:0,
      fixcasetrackingflag:0,
      loadwhensave:false,
      alertsave:'',
      day:[],
      month:[],
      year:[],
      varvalue1:'',
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
    };
      this.columnchangecasetracking = this.columnchangecasetracking.bind(this);
      this.columnchangecasetrackingdefault = this.columnchangecasetrackingdefault.bind(this);
      this.openfixcasetracking = this.openfixcasetracking.bind(this);
      this.closefixcasetracking = this.closefixcasetracking.bind(this);
      this.handlechangevarvalue1 = this.handlechangevarvalue1.bind(this);
      this.submitcasetracking= this.submitcasetracking.bind(this);
      this.updatestage= this.updatestage.bind(this);

  }
  componentDidMount() {

    const url = window.location.href;
    if(url.includes('?mode=open') == true)
    {
        this.setState({casetrackingcolumn:1});
    }
    else
    {
      this.setState({casetrackingcolumn:0});
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
    setInterval(this.updatestage, 1000);
  }

  updatestage()
  {
    //console.log("UPDATEORNOT"+this.props.id);

    axios.get('/wealththaiinsurance/cases/update/stage?fromcase'+this.props.id,{
    }).then(res=>{
      this.setState({
        stage:res.data.stage.name,
        status:res.data.case_status.name,
      })

    });
  }
  handlechangevarvalue1(e){
    //console.log(e.target.value);
    this.setState({
      varvalue1:e.target.value,
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
  openfixcasetracking()
  {
    if(this.props.varvalue5 == null){this.props.varvalue5  = "///"}if(this.props.varvalue6 == null){this.props.varvalue6 = "///"}if(this.props.varvalue7 == null){this.props.varvalue7 = "///"}if(this.props.varvalue8 == null){this.props.varvalue8 = "///"}
    if(this.props.varvalue9 == null){this.props.varvalue9 = "///"}if(this.props.varvalue10 == null){this.props.varvalue10 = "///"}if(this.props.varvalue11 == null){this.props.varvalue11 = "///"}if(this.props.varvalue12 == null){this.props.varvalue12 = "///"}
    if(this.props.varvalue13 == null){this.props.varvalue13 = "///"}if(this.props.varvalue14 == null){this.props.varvalue14 = "///"}if(this.props.varvalue15 == null){this.props.varvalue15 = "///"}if(this.props.varvalue16 == null){this.props.varvalue16 = "///"}
    if(this.props.varvalue17 == null){this.props.varvalue17 = "///"}if(this.props.varvalue18 == null){this.props.varvalue18 = "///"}if(this.props.varvalue19 == null){this.props.varvalue19 = "///"}if(this.props.varvalue20 == null){this.props.varvalue20  = "///"}
    if(this.props.varvalue21 == null){this.props.varvalue21 = "///"}if(this.props.varvalue22 == null){this.props.varvalue22  = "///"}if(this.props.varvalue23 == null){this.props.varvalue23 = "///"}if(this.props.varvalue24 == null){this.props.varvalue24 = "///"}
    if(this.props.varvalue25 == null){this.props.varvalue25 = "///"}if(this.props.varvalue51 == null){this.props.varvalue51 = "///"}if(this.props.varvalue52 == null){this.props.varvalue52 = "///"}if(this.props.varvalue53 == null){this.props.varvalue53 = "///"}
    const var5 = this.props.varvalue5.split('/');this.state.varvalue5day = var5[0];this.state.varvalue5month = var5[1];this.state.varvalue5year = var5[2];
    const var6 = this.props.varvalue6.split('/');this.state.varvalue6day = var6[0];this.state.varvalue6month = var6[1];this.state.varvalue6year = var6[2];
    const var7 = this.props.varvalue7.split('/');this.state.varvalue7day = var7[0];this.state.varvalue7month = var7[1];this.state.varvalue7year = var7[2];
    const var8 = this.props.varvalue8.split('/');this.state.varvalue8day = var8[0];this.state.varvalue8month = var8[1];this.state.varvalue8year = var8[2];
    const var9 = this.props.varvalue9.split('/');this.state.varvalue9day = var9[0];this.state.varvalue9month = var9[1];this.state.varvalue9year = var9[2];
    const var10 = this.props.varvalue10.split('/');this.state.varvalue10day = var10[0];this.state.varvalue10month = var10[1];this.state.varvalue10year = var10[2];
    const var11 = this.props.varvalue11.split('/');this.state.varvalue11day = var11[0];this.state.varvalue11month = var11[1];this.state.varvalue11year = var11[2];
    const var12 = this.props.varvalue12.split('/');this.state.varvalue12day = var12[0];this.state.varvalue12month = var12[1];this.state.varvalue12year = var12[2];
    const var13 = this.props.varvalue13.split('/');this.state.varvalue13day = var13[0];this.state.varvalue13month = var13[1];this.state.varvalue13year = var13[2];
    const var14 = this.props.varvalue14.split('/');this.state.varvalue14day = var14[0];this.state.varvalue14month = var14[1];this.state.varvalue14year = var14[2];
    const var15 = this.props.varvalue15.split('/');this.state.varvalue15day = var15[0];this.state.varvalue15month = var15[1];this.state.varvalue15year = var15[2];
    const var16 = this.props.varvalue16.split('/');this.state.varvalue16day = var16[0];this.state.varvalue16month = var16[1];this.state.varvalue16year = var16[2];
    const var17 = this.props.varvalue17.split('/');this.state.varvalue17day = var17[0];this.state.varvalue17month = var17[1];this.state.varvalue17year = var17[2];
    const var18 = this.props.varvalue18.split('/');this.state.varvalue18day = var18[0];this.state.varvalue18month = var18[1];this.state.varvalue18year = var18[2];
    const var19 = this.props.varvalue19.split('/');this.state.varvalue19day = var19[0];this.state.varvalue19month = var19[1];this.state.varvalue19year = var19[2];
    const var20 = this.props.varvalue20.split('/');this.state.varvalue20day = var20[0];this.state.varvalue20month = var20[1];this.state.varvalue20year = var20[2];
    const var21 = this.props.varvalue21.split('/');this.state.varvalue21day = var21[0];this.state.varvalue21month = var21[1];this.state.varvalue21year = var21[2];
    const var22 = this.props.varvalue22.split('/');this.state.varvalue22day = var22[0];this.state.varvalue22month = var22[1];this.state.varvalue22year = var22[2];
    const var23 = this.props.varvalue23.split('/');this.state.varvalue23day = var23[0];this.state.varvalue23month = var23[1];this.state.varvalue23year = var23[2];
    const var24 = this.props.varvalue24.split('/');this.state.varvalue24day = var24[0];this.state.varvalue24month = var24[1];this.state.varvalue24year = var24[2];
    const var25 = this.props.varvalue25.split('/');this.state.varvalue25day = var25[0];this.state.varvalue25month = var25[1];this.state.varvalue25year = var25[2];
    const var51 = this.props.varvalue51.split('/');this.state.varvalue51day = var51[0];this.state.varvalue51month = var51[1];this.state.varvalue51year = var51[2];
    const var52 = this.props.varvalue52.split('/');this.state.varvalue52day = var52[0];this.state.varvalue52month = var52[1];this.state.varvalue52year = var52[2];
    const var53 = this.props.varvalue53.split('/');this.state.varvalue53day = var53[0];this.state.varvalue53month = var53[1];this.state.varvalue53year = var53[2];
    this.setState({
        fixcasetrackingflag : 1,
    });
  }
  submitcasetracking(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/casetracking',{
      id:this.props.id,
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
      this.setState({
        loadwhensave:true,
      })

      window.location.reload();

    });

  }
  closefixcasetracking()
  {
    this.setState({
        fixcasetrackingflag : 0
    });
  }
  fixcasetracking()
  {
    if(this.state.fixcasetrackingflag == 0)
    {
      return <div className="column"  id="casetracking">
      <div className="box" style={{backgroundColor:'#CDCDCD'}}>
      <div className="box-header" >
        <b className="box-title" >สถานะงาน (Case Tracking)</b>
        <div className="box-tools pull-left">
        <button type="button" onClick={this.openfixcasetracking}className="btn btn-box-tool" ><i style={{color:'orange'}} className="fa fa-gear"></i></button>
          <button type="button" onClick={this.columnchangecasetrackingdefault}className="btn btn-box-tool" ><i className="fa fa-minus"></i></button>
        </div>
      </div>
      <div className="box-body" >
      <div className="column3">
      <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
     <tr role="row" >
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>สถานะงาน</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.state.status}</th>
    </tr>
      <tr role="row" >
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>ขั้นตอนงาน</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.state.stage}</th>
     </tr>
     <tr role="row" >
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>วันที่งานเสร็จสิ้น</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.props.finishdate}</th>
    </tr>
     <tr role="row" >
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname1}</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue1}</th>
    </tr>


      <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>ว้นที่แก้ไขล่าสุด</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.lastupdatedate}</th>
      </tr>

       <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>วันที่ต้องติดตามงาน</th>
        <th style={{backgroundColor:'white'}}>&nbsp;</th>
      </tr>

       <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>วันที่ต่ออายุอัตโนมัติ</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.autorenewdate}</th>
      </tr>
      <tr role="row" >
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>วันที่ กรมธรรม(เดิม) หมดอายุ</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue8}</th>
     </tr>
     <tr role="row" >
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>วันที่ พรบ(เดิม) หมดอายุ </th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue7}</th>
    </tr>
      </thead>
      </table>

      </div>
      <div className="column3">
      <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>


       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>วันที่ ภาษี(เดิม) หมดอายุ </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue9}</th>
      </tr>
      <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname52}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue52}</th>
      </tr>
      <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname51}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue51}</th>
      </tr>
      <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname53}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue53}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname2}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue2}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname3}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue3}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname4}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue4}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname5}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue5}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname6}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue6}</th>
      </tr>

      </thead>
      </table>

      </div>
      <div className="column3">
      <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname7}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue7}</th>
     </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname8}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue8}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname9}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue9}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname10}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue10}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname11}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue11}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname12}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue12}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname13}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue13}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname14}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue14}</th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>&nbsp;</th>
       <th style={{backgroundColor:'#F4F4F6'}}>&nbsp;</th>
     </tr>
      </thead>
      </table>
      </div>
      <div className="column">


      <div className="column3">
      <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname15}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue15}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname16}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue16}</th>
      </tr>

      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname20}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue20}</th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname21}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue21}</th>
     </tr>

    </thead>
      </table>

      </div>
      <div className="column3">
      <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>


      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname22}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue22}</th>
     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname23}</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue23}</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname24}</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue24}</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname25}</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue25}</th>
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
      return <form onSubmit={this.submitcasetracking}><div className="column" id="casetracking">
      <div className="box" style={{backgroundColor:'#FFE0BE'}}>
      <div className="box-header" >
        <b className="box-title" >สถานะงาน (Case Tracking)</b>
        <div className="box-tools pull-left">
        <button type="submit"  className="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button>
        <button type="button" onClick={this.closefixcasetracking}className="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button>
          <button type="button" onClick={this.columnchangecasetrackingdefault}className="btn btn-box-tool" ><i className="fa fa-minus"></i></button>
        </div>
      </div>
      <div className="box-body" >

      <div className="column3">
      <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
     <tr role="row" >
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>สถานะงาน</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.state.status}</th>
    </tr>
      <tr role="row" >
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>ขั้นตอนงาน</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.state.stage}</th>
     </tr>
     <tr role="row" >
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>วันที่งานเสร็จสิ้น</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.props.finishdate}</th>
    </tr>
     <tr role="row" >
    <th  style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname1}</th>
      <th style={{backgroundColor:'white'}}>&nbsp;<input className="form-control" onChange={this.handlechangevarvalue1} value={this.state.varvalue1}/></th>
    </tr>


      <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>ว้นที่แก้ไขล่าสุด</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.lastupdatedate}</th>
      </tr>

       <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>วันที่ต้องติดตามงาน</th>
        <th style={{backgroundColor:'white'}}>&nbsp;</th>
      </tr>

       <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>วันที่ต่ออายุอัตโนมัติ</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.autorenewdate}</th>
      </tr>
       <tr role="row" >
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>วันที่ กรมธรรม(เดิม)หมดอายุ</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue8}</th>
      </tr>
      <tr role="row" >
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>วันที่ พรบ(เดิม) หมดอายุ </th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue7}</th>
     </tr>
      </thead>
      </table>

      </div>
      <div className="column3">
      <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>

       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>วันที่ ภาษี(เดิม) หมดอายุ </th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue9}</th>
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
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname2}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue2}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname3}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue3}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname4}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.varvalue4}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname5} </th>
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

      </thead>
      </table>

      </div>
      <div className="column3">
      <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
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
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname8} </th>
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
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname9} </th>
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
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname10} </th>
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
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname11} </th>
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
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname12} </th>
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
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname13} </th>
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
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname14} </th>
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

          <select  onChange={(e) => this.setState({ varvalue14month: e.target.value })}>
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
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>&nbsp;</th>
       <th style={{backgroundColor:'#F4F4F6'}}>&nbsp;</th>
     </tr>
      </thead>
      </table>
      </div>
      <div className="column">


      <div className="column3">
      <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname15} </th>
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
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname16} </th>
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
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname21} </th>
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
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname22} </th>
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
      <div className="column3">
      <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname20} </th>
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
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname23} </th>
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
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname24} </th>
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
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname25} </th>
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
showdetail()
{
  if(this.state.casetrackingcolumn == 0)
  {
  return <div className="column22" id="casetracking"><div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
  <div className="box-header  ">
    <b className="box-title" >สถานะงาน (Case Tracking)</b>
    <br/>
    <br/>
     <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
     <thead>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>สถานะงาน</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.state.status}</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>ขั้นตอนงาน</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.state.stage}</th>
    </tr>
    <tr role="row" >
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>วันที่งานเสร็จสิ้น</th>
     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.finishdate}</th>
   </tr>
   <tr role="row" >
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>วันที่ต่ออายุอัตโนมัติ</th>
    <th style={{backgroundColor:'white'}}>&nbsp; {this.props.autorenewdate}</th>
  </tr>
   </thead>
     </table>
    <div className="box-tools pull-right">
    <button type="button" onClick={this.columnchangecasetracking} className="btn btn-box-tool" ><i className="fa fa-plus"></i></button>
    </div>
  </div>
  </div>
  </div>
}
return <div>{this.fixcasetracking()}</div>

}

    render() {
      return (
          <div>
          <Modal visible={this.state.loadwhensave} width="150" height="30" effect="fadeInUp" onClickAway={() => this.closeModal()}>

                            <h5 style={{textAlign:'center'}}>กำลังบันทึกข้อมูล</h5>

                  </Modal>
                  {this.showdetail()}</div>
        );
    }
}

if (document.getElementById('casetracking')) {
  const component = document.getElementById('casetracking');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<CaseTracking {...props}/>, component);
}

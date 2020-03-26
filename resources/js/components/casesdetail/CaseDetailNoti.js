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

export default class CaseDetailNoti extends Component {

  constructor(){
    super();
    //console.log(super());
    this.state = {
      casedetailcolumn:0,
      showall:'box collapsed-box',

    };
    this.columnchangecasedetail = this.columnchangecasedetail.bind(this);
    this.columnchangecasedetaildefault = this.columnchangecasedetaildefault.bind(this);

  }
  componentDidMount() {

    const url = window.location.href;
    if(url.includes('?mode=open') == true)
    {
        this.setState({casedetailcolumn:1});
    }
    else
    {
      this.setState({casedetailcolumn:0});
    }
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
  showdetail()
  {
    if(this.state.casedetailcolumn === 0){
    return <div className="column22" id="caseinform">
    <div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
    <div className="box-header  ">
      <b className="box-title" data-widget="collapse">รายละเอียดการแจ้งงาน</b>
      <br/>
      <br/>
       <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
       <thead>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
       <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename4}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue4}</th>
       </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
       <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename5}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue5}</th>
       </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename3}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue3}</th>
      </tr>
        <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
       <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename6}</th>
         <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue6}</th>
       </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
       <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename1}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue1}</th>
       </tr>
       </thead>
       </table>
      <div className="box-tools pull-right">
        <button type="button" onClick={this.columnchangecasedetail} className="btn btn-box-tool" ><i className="fa fa-plus"></i></button>
      </div>
    </div>

    </div>
    </div>
  }
  else
  {
    return  <div className="column" id="caseinform">
    <div className="box" style={{backgroundColor:'#CDCDCD'}}>
    <div className="box-header  ">
      <b className="box-title">รายละเอียดการแจ้งงาน</b>
      <br/>
      <br/>
      <div className="box-tools pull-right">
        <button type="button" onClick={this.columnchangecasedetaildefault} className="btn btn-box-tool" ><i className="fa fa-minus"></i></button>
      </div>
    </div>
    <div className="box-body" >
    <div className="column3">
    <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename1}</th>
     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue1}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename2}</th>
     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue2}</th>
   </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename3}</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue3}</th>
    </tr>



    </thead>
    </table>
    </div>
    <div className="column3">
    <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename4}</th>
     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue4}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename5}</th>
     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue5}</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename6}</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue6}</th>
    </tr>
    </thead>
    </table>
    </div>
    <div className="column3">
    <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename7}</th>
     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue7}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename8}</th>
     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue8}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename9}</th>
     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue9}</th>
   </tr>

    </thead>
    </table>
    </div>
    <div className="column3">
    <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename10}</th>
   <div style={{overflowX:'auto',height:'90px',backgroundColor:'white',border:'0.5px solid #E3E3E3'}}><th style={{backgroundColor:'white',height:'80px'}}>&nbsp;{this.props.requirevalue10}</th></div>
   </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename11}</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue11}</th>
    </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename12}</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue12}</th>
    </tr>

    </thead>
    </table>
    </div>
    <div className="column3">
    <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename13}</th>
     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue13}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename14}</th>
     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue14}</th>
   </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.requirename15}</th>
     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.requirevalue15}</th>
   </tr>
    </thead>
    </table>
    </div>
    </div>
    </div>
    </div>
  }
  }
    render() {
      return (
        <div>{this.showdetail()}</div>
        );
    }
}

if (document.getElementById('casedetailnoti')) {
  const component = document.getElementById('casedetailnoti');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<CaseDetailNoti {...props}/>, component);
}

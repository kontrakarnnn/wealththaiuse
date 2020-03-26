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

export default class CaseDetail extends Component {

  constructor(){
    super();
    //console.log(super());
    this.state = {
      showall:'box collapsed-box',
    };

  }
  componentDidMount() {

    const url = window.location.href;
    if(url.includes('?mode=open') == true)
    {
        this.setState({showall:'box'});
    }
    else
    {
      this.setState({showall:'box collapsed-box'});
    }
  }
  showdetail()
  {
    return  <div className="column2" id="casedetail">
                 <div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
                 <div className="box-header  ">
                 <b className="box-title" >รายละเอียดงาน</b>
                 <br/>
                 <br/>
                  <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>ผู้บันทึก/ส่งคำร้อง</th>
                   <th style={{backgroundColor:'white'}}>&nbsp; {this.props.matchid}</th>
                  </tr>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>ผู้ให้บริการ /ผู้แจ้งงาน </th>
                  <th style={{backgroundColor:'white'}}>&nbsp;{this.props.userblock}</th>
                  </tr>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>ผู้ประสานงาน</th>
                  <th style={{backgroundColor:'white'}}>&nbsp;{this.props.coordinator} </th>
                  </tr>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>ผู้ให้คำปรึกษา/ผู้ให้คำแนะนำ
                  </th>
                  <th style={{backgroundColor:'white'}}>&nbsp;{this.props.consultpartner}</th>
                  </tr>
                  </thead>
                  </table>
                 <div className="box-tools pull-right">
                   <button type="button" className="btn btn-box-tool" data-widget="collapse"><i className="fa fa-plus"></i></button>
                 </div>
                 </div>
                 <div className="box-body" style={{}}>
                 <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                 <thead>
                 <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                 <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>เส้นทางรับงาน
                 </th>
                 <th style={{backgroundColor:'white'}}>&nbsp;{this.props.casechannel}</th>
                 </tr>
                 <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                 <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >สินทรัพย์อ้างอิง</th>
                 <th style={{backgroundColor:'white'}}>&nbsp;{this.props.caserefasset}</th>
                 </tr>
                 <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                 <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >&nbsp;</th>
                 <th style={{backgroundColor:'white'}}>&nbsp;&nbsp;</th>
                 </tr>
                 </thead>
                 </table>
                 </div>
                 </div>
                 </div>

  }
    render() {
      return ( <div>{this.showdetail()} </div>
        );
    }
}

if (document.getElementById('casedetail')) {
  const component = document.getElementById('casedetail');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<CaseDetail {...props}/>, component);
}

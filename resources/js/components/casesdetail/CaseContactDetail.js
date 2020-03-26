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

export default class CaseContactDetail extends Component {

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

    render() {
      return (
        <div className="column22" id="contactdetail">
        <div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
        <div className="box-header  ">
          <b className="box-title" data-widget="collapse">ข้อมูลผู้ติดต่อ</b>
          <br/>
          <br/>

           <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
           <thead>
           <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
          <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname16}</th>
            <th style={{backgroundColor:'white'}}>{this.props.varvalue16}</th>
          </tr>
           <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
          <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname17}</th>
            <th style={{backgroundColor:'white'}}>{this.props.varvalue17}</th>
          </tr>
          <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
         <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname18}</th>
           <th style={{backgroundColor:'white'}}>{this.props.varvalue18}</th>
         </tr>
          <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
         <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname20}</th>
           <th style={{backgroundColor:'white'}}>{this.props.varvalue20}</th>
         </tr>
          <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
         <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname19}</th>
         <div style={{overflowX:'auto',height:'90px',backgroundColor:'white',border:'0.5px solid #E3E3E3'}}><th style={{backgroundColor:'white',height:'90px'}}>{this.props.varvalue19}</th></div>
         </tr>
          </thead>
           </table>
          <div className="box-tools pull-right">
          </div>
        </div>

        </div>

        </div>

        );
    }
}

if (document.getElementById('casecontactdetail')) {
  const component = document.getElementById('casecontactdetail');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<CaseContactDetail {...props}/>, component);
}

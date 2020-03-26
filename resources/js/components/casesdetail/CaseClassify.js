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

export default class CaseClassify extends Component {

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
    return <div className="column2">
    <div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
    <div className="box-header  ">
      <b className="box-title">ข้อมูลจำแนกงาน</b>
      <br/>
      <br/>


       <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
       <thead>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >รหัสงาน</th>
        <th style={{backgroundColor:'white',textAlign:'center'}}>&nbsp; {this.props.id}</th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>ประเภทของใบงาน</th>
     <th style={{backgroundColor:'white',textAlign:'center'}}>
     {this.props.casecat}
     </th>
     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >ชนิดของใบงาน</th>
      <th style={{backgroundColor:'white',textAlign:'center'}}>&nbsp; {this.props.casetype}</th>
     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>ชื่อใบงาน</th>
     <th style={{backgroundColor:'white',textAlign:'center'}}>&nbsp; {this.props.casename}</th>
     </tr>

     </thead>
       </table>
      <div className="box-tools pull-right">
        <button type="button" className="btn btn-box-tool" data-widget="collapse"><i className="fa fa-plus"></i></button>
      </div>

    </div>

    <div className="box-body" style={{}} >
    <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
    <thead>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >ชนิดย่อยของใบงาน</th>
      <th style={{backgroundColor:'white',textAlign:'center'}}>&nbsp; {this.props.casesubtype}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >งานเดิม</th>
     <th style={{backgroundColor:'white',textAlign:'center'}}>&nbsp; <a href={'/wealththaiinsurance/cases/'+this.props.oldcaseid+'/detail/show'}>{this.props.oldcase}</a></th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >งานใหม่</th>
    <th style={{backgroundColor:'white',textAlign:'center'}}>&nbsp; <a href={'/wealththaiinsurance/cases/'+this.props.renewcaseid+'/detail/show'}>{this.props.renewcase}</a></th>
  </tr>
    </thead>
    </table>
    </div>
    </div>
    </div>
  }
    render() {
      return (
            <div>{this.showdetail()}</div>
        );
    }
}

if (document.getElementById('caseclassify')) {
  const component = document.getElementById('caseclassify');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<CaseClassify {...props}/>, component);
}

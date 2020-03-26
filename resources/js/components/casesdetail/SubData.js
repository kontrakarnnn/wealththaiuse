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

export default class SubData extends Component {

  constructor(){
    super();
    //console.log(super());
    this.state = {
      showall:'box collapsed-box',
      varvalue47:'',
      varvalue48:'',
      varvalue49:'',
      varvalue50:'',
      flagvarvalue47:0,
      flagvarvalue48:0,
      flagvarvalue49:0,
      flagvarvalue50:0,

    };
    this.openfixins47= this.openfixins47.bind(this);
    this.closefixins47= this.closefixins47.bind(this);
    this.handleSubmitfixins47= this.handleSubmitfixins47.bind(this);
    this.openfixins48= this.openfixins48.bind(this);
    this.closefixins48= this.closefixins48.bind(this);
    this.handleSubmitfixins48= this.handleSubmitfixins48.bind(this);
    this.openfixins49= this.openfixins49.bind(this);
    this.closefixins49= this.closefixins49.bind(this);
    this.handleSubmitfixins49= this.handleSubmitfixins49.bind(this);
    this.openfixins50= this.openfixins50.bind(this);
    this.closefixins50= this.closefixins50.bind(this);
    this.handleSubmitfixins50= this.handleSubmitfixins50.bind(this);
  }
  componentDidMount() {
    this.setState({varvalue47:this.props.varvalue47,
                   varvalue48:this.props.varvalue48,
                   varvalue49:this.props.varvalue49,
                   varvalue50:this.props.varvalue50,});
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
  openfixins47()
  {
    this.setState({
      flagvarvalue47:1
    })
  }
  closefixins47()
  {
    this.setState({
      flagvarvalue47:0
    })
  }
  fixins47()
  {
    if(this.state.flagvarvalue47 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins47}><input onChange={(e) => this.setState({ varvalue47: e.target.value })} value={this.state.varvalue47} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins47}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue47}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins47}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins47(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins47',{
      id:this.props.id,
      fixins47:this.state.varvalue47,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue47:this.state.varvalue47,
        flagvarvalue47:0,
      })
    });
  }
  openfixins48()
  {
    this.setState({
      flagvarvalue48:1
    })
  }
  closefixins48()
  {
    this.setState({
      flagvarvalue48:0
    })
  }
  fixins48()
  {
    if(this.state.flagvarvalue48 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins48}><input onChange={(e) => this.setState({ varvalue48: e.target.value })} value={this.state.varvalue48} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins48}class="btn btn-box-tool" ><span style={{color:'red'}} onClick={this.closefixins48}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue48}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins48}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins48(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins48',{
      id:this.props.id,
      fixins48:this.state.varvalue48,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue48:this.state.varvalue48,
        flagvarvalue48:0,
      })
    });
  }
  openfixins49()
  {
    this.setState({
      flagvarvalue49:1
    })
  }
  closefixins49()
  {
    this.setState({
      flagvarvalue49:0
    })
  }
  fixins49()
  {
    if(this.state.flagvarvalue49 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins49}><input onChange={(e) => this.setState({ varvalue49: e.target.value })} value={this.state.varvalue49} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins47}class="btn btn-box-tool" ><span style={{color:'red'}} onClick={this.closefixins49}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue49}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins49}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins49(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins49',{
      id:this.props.id,
      fixins49:this.state.varvalue49,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue49:this.state.varvalue49,
        flagvarvalue49:0,
      })
    });
  }
  openfixins50()
  {
    this.setState({
      flagvarvalue50:1
    })
  }
  closefixins50()
  {
    this.setState({
      flagvarvalue50:0
    })
  }
  fixins50()
  {
    if(this.state.flagvarvalue50 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins50}><input onChange={(e) => this.setState({ varvalue50: e.target.value })} value={this.state.varvalue50} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins47}class="btn btn-box-tool" ><span style={{color:'red'}} onClick={this.closefixins50}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue50}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins50}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins50(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins50',{
      id:this.props.id,
      fixins50:this.state.varvalue50,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue50:this.state.varvalue50,
        flagvarvalue50:0,
      })
    });
  }
  showdetail()
  {
    return <div className="column2">
    <div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
    <div className="box-header  ">
      <b className="box-title">ข้อมูลสำรอง</b>
      <br/>
      <br/>
       <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
       <thead>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.varname48}</th>
        <th style={{backgroundColor:'white',textAlign:'center'}}>{this.fixins48()}</th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname47}</th>
     <th style={{backgroundColor:'white',textAlign:'center'}}>
     {this.fixins47()}
     </th>
     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.varname49}</th>
      <th style={{backgroundColor:'white',textAlign:'center'}}>{this.fixins49()}</th>
     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname50}</th>
     <th style={{backgroundColor:'white',textAlign:'center'}}>{this.fixins50()}</th>
     </tr>

     </thead>
       </table>
      <div className="box-tools pull-right">

      </div>

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

if (document.getElementById('subdata')) {
  const component = document.getElementById('subdata');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<SubData {...props}/>, component);
}

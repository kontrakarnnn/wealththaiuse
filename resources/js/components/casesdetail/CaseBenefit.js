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

export default class CaseBenefit extends Component {

  constructor(){
    super();
    //console.log(super());
    this.state = {
      showall:'box collapsed-box',
      varvalue54:'',
      varvalue59:'',
      varvalue60:'',
      varvalue61:'',
      varvalue62:'',
      varvalue63:'',
      varvalue64:'',
      varvalue65:'',
      varvalue66:'',
      varvalue67:'',
      varvalue68:'',
      varvalue69:'',
      flagvarvalue54:0,
      flagvarvalue59:0,
      flagvarvalue60:0,
      flagvarvalue61:0,
      flagvarvalue62:0,
      flagvarvalue63:0,
      flagvarvalue64:0,
      flagvarvalue65:0,
      flagvarvalue66:0,
      flagvarvalue67:0,
      flagvarvalue68:0,
      flagvarvalue69:0,
      changeview:0,
    };
    this.changeview= this.changeview.bind(this);
    this.changeviewdefault= this.changeviewdefault.bind(this);
    this.openfixins54= this.openfixins54.bind(this);
    this.closefixins54= this.closefixins54.bind(this);
    this.handleSubmitfixins54= this.handleSubmitfixins54.bind(this);
    this.openfixins59= this.openfixins59.bind(this);
    this.closefixins59= this.closefixins59.bind(this);
    this.handleSubmitfixins59= this.handleSubmitfixins59.bind(this);
    this.openfixins60= this.openfixins60.bind(this);
    this.closefixins60= this.closefixins60.bind(this);
    this.handleSubmitfixins60= this.handleSubmitfixins60.bind(this);
    this.openfixins61= this.openfixins61.bind(this);
    this.closefixins61= this.closefixins61.bind(this);
    this.handleSubmitfixins61= this.handleSubmitfixins61.bind(this);
    this.openfixins62= this.openfixins62.bind(this);
    this.closefixins62= this.closefixins62.bind(this);
    this.handleSubmitfixins62= this.handleSubmitfixins62.bind(this);
    this.openfixins63= this.openfixins63.bind(this);
    this.closefixins63= this.closefixins63.bind(this);
    this.handleSubmitfixins63= this.handleSubmitfixins63.bind(this);
    this.openfixins64= this.openfixins64.bind(this);
    this.closefixins64= this.closefixins64.bind(this);
    this.handleSubmitfixins64= this.handleSubmitfixins64.bind(this);
    this.openfixins65= this.openfixins65.bind(this);
    this.closefixins65= this.closefixins65.bind(this);
    this.handleSubmitfixins65= this.handleSubmitfixins65.bind(this);
    this.openfixins66= this.openfixins66.bind(this);
    this.closefixins66= this.closefixins66.bind(this);
    this.handleSubmitfixins66= this.handleSubmitfixins66.bind(this);
    this.openfixins67= this.openfixins67.bind(this);
    this.closefixins67= this.closefixins67.bind(this);
    this.handleSubmitfixins67= this.handleSubmitfixins67.bind(this);
    this.openfixins68= this.openfixins68.bind(this);
    this.closefixins68= this.closefixins68.bind(this);
    this.handleSubmitfixins68= this.handleSubmitfixins68.bind(this);
    this.openfixins69= this.openfixins69.bind(this);
    this.closefixins69= this.closefixins69.bind(this);
    this.handleSubmitfixins69= this.handleSubmitfixins69.bind(this);
  }
  componentDidMount() {
    this.setState({varvalue54:this.props.varvalue54,
                   varvalue59:this.props.varvalue59,
                   varvalue60:this.props.varvalue60,
                   varvalue61:this.props.varvalue61,
                   varvalue62:this.props.varvalue62,
                   varvalue63:this.props.varvalue63,
                   varvalue64:this.props.varvalue64,
                   varvalue65:this.props.varvalue65,
                   varvalue66:this.props.varvalue66,
                   varvalue67:this.props.varvalue67,
                   varvalue68:this.props.varvalue68,
                   varvalue69:this.props.varvalue69,});
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
changeview()
{
  this.setState({
    changeview:1
  })
}
changeviewdefault()
{
  this.setState({
    changeview:0
  })
}
  openfixins54()
  {
    this.setState({
      flagvarvalue54:1
    })
  }
  closefixins54()
  {
    this.setState({
      flagvarvalue54:0
    })
  }
  fixins54()
  {
    if(this.state.flagvarvalue54 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins54}><input onChange={(e) => this.setState({ varvalue54: e.target.value })} value={this.state.varvalue54} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins54}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue54}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins54}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins54(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins54',{
      id:this.props.id,
      fixins54:this.state.varvalue54,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue54:this.state.varvalue54,
        flagvarvalue54:0,
      })
    });
  }
  openfixins59()
  {
    this.setState({
      flagvarvalue59:1
    })
  }
  closefixins59()
  {
    this.setState({
      flagvarvalue59:0
    })
  }
  fixins59()
  {
    if(this.state.flagvarvalue59 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins59}><input onChange={(e) => this.setState({ varvalue59: e.target.value })} value={this.state.varvalue59} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins59}class="btn btn-box-tool" ><span style={{color:'red'}} onClick={this.closefixins59}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue59}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins59}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins59(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins59',{
      id:this.props.id,
      fixins59:this.state.varvalue59,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue59:this.state.varvalue59,
        flagvarvalue59:0,
      })
    });
  }
  openfixins60()
  {
    this.setState({
      flagvarvalue60:1
    })
  }
  closefixins60()
  {
    this.setState({
      flagvarvalue60:0
    })
  }
  fixins60()
  {
    if(this.state.flagvarvalue60 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins60}><input onChange={(e) => this.setState({ varvalue60: e.target.value })} value={this.state.varvalue60} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins47}class="btn btn-box-tool" ><span style={{color:'red'}} onClick={this.closefixins60}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue60}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins60}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins60(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins60',{
      id:this.props.id,
      fixins60:this.state.varvalue60,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue60:this.state.varvalue60,
        flagvarvalue60:0,
      })
    });
  }
  openfixins61()
  {
    this.setState({
      flagvarvalue61:1
    })
  }
  closefixins61()
  {
    this.setState({
      flagvarvalue61:0
    })
  }
  fixins61()
  {
    if(this.state.flagvarvalue61 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins61}><input onChange={(e) => this.setState({ varvalue61: e.target.value })} value={this.state.varvalue61} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins47}class="btn btn-box-tool" ><span style={{color:'red'}} onClick={this.closefixins61}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue61}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins61}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins61(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins61',{
      id:this.props.id,
      fixins61:this.state.varvalue61,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue61:this.state.varvalue61,
        flagvarvalue61:0,
      })
    });
  }
  openfixins62()
  {
    this.setState({
      flagvarvalue62:1
    })
  }
  closefixins62()
  {
    this.setState({
      flagvarvalue62:0
    })
  }
  fixins62()
  {
    if(this.state.flagvarvalue62 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins62}><input onChange={(e) => this.setState({ varvalue62: e.target.value })} value={this.state.varvalue62} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins62}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue62}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins62}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins62(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins62',{
      id:this.props.id,
      fixins62:this.state.varvalue62,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue62:this.state.varvalue62,
        flagvarvalue62:0,
      })
    });
  }
  openfixins63()
  {
    this.setState({
      flagvarvalue63:1
    })
  }
  closefixins63()
  {
    this.setState({
      flagvarvalue63:0
    })
  }
  fixins63()
  {
    if(this.state.flagvarvalue63 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins63}><input onChange={(e) => this.setState({ varvalue63: e.target.value })} value={this.state.varvalue63} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins63}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue63}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins63}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins63(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins63',{
      id:this.props.id,
      fixins63:this.state.varvalue63,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue63:this.state.varvalue63,
        flagvarvalue63:0,
      })
    });
  }
  openfixins64()
  {
    this.setState({
      flagvarvalue64:1
    })
  }
  closefixins64()
  {
    this.setState({
      flagvarvalue64:0
    })
  }
  fixins64()
  {
    if(this.state.flagvarvalue64 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins64}><input onChange={(e) => this.setState({ varvalue64: e.target.value })} value={this.state.varvalue64} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins64}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue64}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins64}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins64(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins64',{
      id:this.props.id,
      fixins64:this.state.varvalue64,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue64:this.state.varvalue64,
        flagvarvalue64:0,
      })
    });
  }
  openfixins65()
  {
    this.setState({
      flagvarvalue65:1
    })
  }
  closefixins65()
  {
    this.setState({
      flagvarvalue65:0
    })
  }
  fixins65()
  {
    if(this.state.flagvarvalue65 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins65}><input onChange={(e) => this.setState({ varvalue65: e.target.value })} value={this.state.varvalue65} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins65}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue65}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins65}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins65(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins65',{
      id:this.props.id,
      fixins65:this.state.varvalue65,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue65:this.state.varvalue65,
        flagvarvalue65:0,
      })
    });
  }
  openfixins66()
  {
    this.setState({
      flagvarvalue66:1
    })
  }
  closefixins66()
  {
    this.setState({
      flagvarvalue66:0
    })
  }
  fixins66()
  {
    if(this.state.flagvarvalue66 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins66}><input onChange={(e) => this.setState({ varvalue66: e.target.value })} value={this.state.varvalue66} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins66}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue66}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins66}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins66(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins66',{
      id:this.props.id,
      fixins66:this.state.varvalue66,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue66:this.state.varvalue66,
        flagvarvalue66:0,
      })
    });
  }
  openfixins67()
  {
    this.setState({
      flagvarvalue67:1
    })
  }
  closefixins67()
  {
    this.setState({
      flagvarvalue67:0
    })
  }
  fixins67()
  {
    if(this.state.flagvarvalue67 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins67}><input onChange={(e) => this.setState({ varvalue67: e.target.value })} value={this.state.varvalue67} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins67}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue67}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins67}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins67(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins67',{
      id:this.props.id,
      fixins67:this.state.varvalue67,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue67:this.state.varvalue67,
        flagvarvalue67:0,
      })
    });
  }
  openfixins68()
  {
    this.setState({
      flagvarvalue68:1
    })
  }
  closefixins68()
  {
    this.setState({
      flagvarvalue68:0
    })
  }
  fixins68()
  {
    if(this.state.flagvarvalue68 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins68}><input onChange={(e) => this.setState({ varvalue68: e.target.value })} value={this.state.varvalue68} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins68}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue68}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins68}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins68(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins68',{
      id:this.props.id,
      fixins68:this.state.varvalue68,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue68:this.state.varvalue68,
        flagvarvalue68:0,
      })
    });
  }
  openfixins69()
  {
    this.setState({
      flagvarvalue69:1
    })
  }
  closefixins69()
  {
    this.setState({
      flagvarvalue69:0
    })
  }
  fixins69()
  {
    if(this.state.flagvarvalue69 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins69}><input onChange={(e) => this.setState({ varvalue69: e.target.value })} value={this.state.varvalue69} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins69}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue69}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins69}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins69(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins69',{
      id:this.props.id,
      fixins69:this.state.varvalue69,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue69:this.state.varvalue69,
        flagvarvalue69:0,
      })
    });
  }
  showdetail()
  {
    if(this.state.changeview == 1)
    {
      return <div className="column" id="caseinform">
      <div className="box" style={{backgroundColor:'#CDCDCD'}}>
      <div className="box-header  ">
        <b className="box-title">ผู้รับผลประโยชน์</b>
        <br/>
        <br/>
        <div className="box-tools pull-right">
          <button type="button" onClick={this.changeviewdefault} className="btn btn-box-tool" ><i className="fa fa-minus"></i></button>
        </div>
      </div>
      <div className="box-body" >
      <div className="column3">
      <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname60}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins60()}</th>
     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname61}</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins61()}</th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname62}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins62()}</th>
      </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname63}</th>
        <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins63()}</th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname64}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins64()}</th>
     </tr>

      </thead>
      </table>
      </div>
      <div className="column3">
      <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>

      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname65}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins65()}</th>
     </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname66}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins66()}</th>
     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname67}</th>
      <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins67()}</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname68}</th>
     <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins68()}</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname69}</th>
    <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins69()}</th>
  </tr>
      </thead>
      </table>
      </div>
      <div className="column3">
      <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
      <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname54}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins54()}</th>
      </tr>
      <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
     <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname59}</th>
       <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins59()}</th>
     </tr>
     <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>&nbsp;</th>
      <th style={{backgroundColor:'white'}}>&nbsp;</th>
    </tr>
    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
   <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>&nbsp;</th>
     <th style={{backgroundColor:'white'}}>&nbsp;</th>
   </tr>
   <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>&nbsp;</th>
    <th style={{backgroundColor:'white'}}>&nbsp;</th>
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

    return  <div className="column2" id="casedetail">
                 <div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
                 <div className="box-header  ">
                 <b className="box-title" >ข้อมูลผู้รับผลประโยชน์</b>
                 <br/>
                 <br/>
                  <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname54}</th>
                   <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins54()}</th>
                  </tr>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname59}</th>
                  <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins59()}</th>
                  </tr>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname60}</th>
                  <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins60()}</th>
                  </tr>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname61}
                  </th>
                  <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins61()}</th>
                  </tr>
                  </thead>
                  </table>
                  <div className="box-tools pull-right">
                    <button type="button" className="btn btn-box-tool" onClick={this.changeview}><i className="fa fa-plus"></i></button>
                  </div>
                 </div>

                 </div>
                 </div>

               }
  }
    render() {
      return ( <div>{this.showdetail()} </div>
        );
    }
}

if (document.getElementById('casebenefit')) {
  const component = document.getElementById('casebenefit');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<CaseBenefit {...props}/>, component);
}

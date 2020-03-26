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

export default class CaseDriver extends Component {

  constructor(){
    super();
    //console.log(super());
    this.state = {
      showall:'box collapsed-box',
      varvalue55:'',
      varvalue56:'',
      varvalue57:'',
      varvalue58:'',
      flagvarvalue55:0,
      flagvarvalue56:0,
      flagvarvalue57:0,
      flagvarvalue58:0,
    };
    this.openfixins55= this.openfixins55.bind(this);
    this.closefixins55= this.closefixins55.bind(this);
    this.handleSubmitfixins55= this.handleSubmitfixins55.bind(this);
    this.openfixins56= this.openfixins56.bind(this);
    this.closefixins56= this.closefixins56.bind(this);
    this.handleSubmitfixins56= this.handleSubmitfixins56.bind(this);
    this.openfixins57= this.openfixins57.bind(this);
    this.closefixins57= this.closefixins57.bind(this);
    this.handleSubmitfixins57= this.handleSubmitfixins57.bind(this);
    this.openfixins58= this.openfixins58.bind(this);
    this.closefixins58= this.closefixins58.bind(this);
    this.handleSubmitfixins58= this.handleSubmitfixins58.bind(this);
  }
  componentDidMount() {
    this.setState({varvalue55:this.props.varvalue55,
                   varvalue56:this.props.varvalue56,
                   varvalue57:this.props.varvalue57,
                   varvalue58:this.props.varvalue58,});
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

  openfixins55()
  {
    this.setState({
      flagvarvalue55:1
    })
  }
  closefixins55()
  {
    this.setState({
      flagvarvalue55:0
    })
  }
  fixins55()
  {
    if(this.state.flagvarvalue55 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins55}><input onChange={(e) => this.setState({ varvalue55: e.target.value })} value={this.state.varvalue55} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins55}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue55}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins55}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins55(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins55',{
      id:this.props.id,
      fixins55:this.state.varvalue55,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue55:this.state.varvalue55,
        flagvarvalue55:0,
      })
    });
  }
  openfixins56()
  {
    this.setState({
      flagvarvalue56:1
    })
  }
  closefixins56()
  {
    this.setState({
      flagvarvalue56:0
    })
  }
  fixins56()
  {
    if(this.state.flagvarvalue56 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins56}><input onChange={(e) => this.setState({ varvalue56: e.target.value })} value={this.state.varvalue56} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins56}class="btn btn-box-tool" ><span style={{color:'red'}} onClick={this.closefixins56}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue56}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins56}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins56(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins56',{
      id:this.props.id,
      fixins56:this.state.varvalue56,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue56:this.state.varvalue56,
        flagvarvalue56:0,
      })
    });
  }
  openfixins57()
  {
    this.setState({
      flagvarvalue57:1
    })
  }
  closefixins57()
  {
    this.setState({
      flagvarvalue57:0
    })
  }
  fixins57()
  {
    if(this.state.flagvarvalue57 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins57}><input onChange={(e) => this.setState({ varvalue57: e.target.value })} value={this.state.varvalue57} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins47}class="btn btn-box-tool" ><span style={{color:'red'}} onClick={this.closefixins57}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue57}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins57}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins57(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins57',{
      id:this.props.id,
      fixins57:this.state.varvalue57,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue57:this.state.varvalue57,
        flagvarvalue57:0,
      })
    });
  }
  openfixins58()
  {
    this.setState({
      flagvarvalue58:1
    })
  }
  closefixins58()
  {
    this.setState({
      flagvarvalue58:0
    })
  }
  fixins58()
  {
    if(this.state.flagvarvalue58 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins58}><input onChange={(e) => this.setState({ varvalue58: e.target.value })} value={this.state.varvalue58} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins47}class="btn btn-box-tool" ><span style={{color:'red'}} onClick={this.closefixins58}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.varvalue58}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins58}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins58(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins58',{
      id:this.props.id,
      fixins58:this.state.varvalue58,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        varvalue58:this.state.varvalue58,
        flagvarvalue58:0,
      })
    });
  }

  showdetail()
  {
    return  <div className="column2" id="casedetail">
                 <div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
                 <div className="box-header  ">
                 <b className="box-title" >ข้อมูลผู้ขับขี่</b>
                 <br/>
                 <br/>
                  <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname55}</th>
                   <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins55()}</th>
                  </tr>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname56}</th>
                  <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins56()}</th>
                  </tr>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname57}</th>
                  <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins57()}</th>
                  </tr>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname58}
                  </th>
                  <th style={{backgroundColor:'white'}}>&nbsp;{this.fixins58()}</th>
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
      return ( <div>{this.showdetail()} </div>
        );
    }
}

if (document.getElementById('casedriver')) {
  const component = document.getElementById('casedriver');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<CaseDriver {...props}/>, component);
}

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

export default class OfferInsurance extends Component {

  constructor(){
    super();
    ////console.log(super());
    this.state = {
      day:[],
      month:[],
      year:[],
      varvalue11day:'',varvalue11month:'',varvalue11year:'',
      varvalue14day:'',varvalue14month:'',varvalue14year:'',
      varvalue52day:'',varvalue52month:'',varvalue52year:'',
      showall:'box collapsed-box',
      flagfixins41:0,
      fixins41:'',
      defaultvarvalue41:'',
      flagfixins11:0,
      fixins11:'',
      defaultvarvalue11:'',
      flagfixins14:0,
      fixins14:'',
      defaultvarvalue14:'',
      flagfixins52:0,
      fixins52:'',
      defaultvarvalue52:'',
      defaultfileflag:'',
      flagfixins42:0,
      fixins42:'',
      defaultvarvalue42:'',
      flagfixins43:0,
      fixins43:'',
      defaultvarvalue43:'',
      day43:'',
      month43:'',
      year43:'',
    };
    this.openfixins41= this.openfixins41.bind(this);
    this.closefixins41= this.closefixins41.bind(this);
    this.handleChangefixins41= this.handleChangefixins41.bind(this);
    this.handleSubmitfixins41= this.handleSubmitfixins41.bind(this);
    this.openfixins11= this.openfixins11.bind(this);
    this.closefixins11= this.closefixins11.bind(this);
    this.openfixins14= this.openfixins14.bind(this);
    this.closefixins14= this.closefixins14.bind(this);
    this.openfixins52= this.openfixins52.bind(this);
    this.closefixins52= this.closefixins52.bind(this);
    this.handleChangefixins11= this.handleChangefixins11.bind(this);
    this.handleSubmitfixins11= this.handleSubmitfixins11.bind(this);
    this.handleChangefixins52= this.handleChangefixins52.bind(this);
    this.handleSubmitfixins52= this.handleSubmitfixins52.bind(this);
    this.handleChangefixins14= this.handleChangefixins14.bind(this);
    this.handleSubmitfixins14= this.handleSubmitfixins14.bind(this);
    this.openfixins42= this.openfixins42.bind(this);
    this.closefixins42= this.closefixins42.bind(this);
    this.handleChangefixins42= this.handleChangefixins42.bind(this);
    this.handleSubmitfixins42= this.handleSubmitfixins42.bind(this);
    this.openfixins43= this.openfixins43.bind(this);
    this.closefixins43= this.closefixins43.bind(this);
    this.handleChangefixins43= this.handleChangefixins43.bind(this);
    this.handleSubmitfixins43= this.handleSubmitfixins43.bind(this);
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
    axios.get('/wealththaiinsurance/load/day').then(response=>{
      this.setState({day:response.data});
    })
    axios.get('/wealththaiinsurance/load/month').then(response=>{
      this.setState({month:response.data});
    })
    axios.get('/wealththaiinsurance/load/year').then(response=>{
      this.setState({year:response.data});
    })
    this.setState({
      defaultvarvalue14:this.props.varvalue14,
      defaultvarvalue52:this.props.varvalue52,
      defaultvarvalue11:this.props.varvalue11,
      defaultvarvalue41:this.props.varvalue41,
      defaultvarvalue42:this.props.varvalue42,
      defaultvarvalue43:this.props.varvalue43,
    })
  }
  handleSubmitfixins52(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins52',{
      id:this.props.id,
      fixins52:this.state.varvalue52day+'/'+this.state.varvalue52month+'/'+this.state.varvalue52year,
    }).then(res=>{

      //console.log(res.data);
      this.setState({
        defaultvarvalue52:this.state.varvalue52day+'/'+this.state.varvalue52month+'/'+this.state.varvalue52year,
        flagfixins52:0,
      })
    });
  }
  handleChangefixins52(e){
    //console.log(e.target.value);
    this.setState({
      fixins52:e.target.value,
    })
  }
  openfixins52()
  {
    this.setState({
      flagfixins52:1
    })
  }
  closefixins52()
  {
    this.setState({
      flagfixins52:0
    })
  }
  fixins52()
  {
    if(this.state.flagfixins52 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins52}><tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
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
       </select></th>
     </tr>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins52}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.defaultvarvalue52}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins52}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins14(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins14',{
      id:this.props.id,
      fixins14:this.state.varvalue14day+'/'+this.state.varvalue14month+'/'+this.state.varvalue14year,
    }).then(res=>{

      //console.log(res.data);
      this.setState({
        defaultvarvalue14:this.state.varvalue14day+'/'+this.state.varvalue14month+'/'+this.state.varvalue14year,
        flagfixins14:0,
      })
    });
  }
  handleChangefixins14(e){
    //console.log(e.target.value);
    this.setState({
      fixins14:e.target.value,
    })
  }
  openfixins14()
  {
    this.setState({
      flagfixins14:1
    })
  }
  closefixins14()
  {
    this.setState({
      flagfixins14:0
    })
  }
  fixins14()
  {
    if(this.state.flagfixins14 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins14}><tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
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
       </select></th>
     </tr>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins14}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.defaultvarvalue14}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins14}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins11(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins11',{
      id:this.props.id,
      fixins11:this.state.varvalue11day+'/'+this.state.varvalue11month+'/'+this.state.varvalue11year,
    }).then(res=>{

      //console.log(res.data);
      this.setState({
        defaultvarvalue11:this.state.varvalue11day+'/'+this.state.varvalue11month+'/'+this.state.varvalue11year,
        flagfixins11:0,
      })
    });
  }
  handleChangefixins11(e){
    //console.log(e.target.value);
    this.setState({
      fixins11:e.target.value,
    })
  }
  openfixins11()
  {
    this.setState({
      flagfixins11:1
    })
  }
  closefixins11()
  {
    this.setState({
      flagfixins11:0
    })
  }
  fixins11()
  {
    if(this.state.flagfixins11 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins11}><tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
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
       </select></th>
     </tr>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins11}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.defaultvarvalue11}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins11}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins41(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins41',{
      id:this.props.id,
      fixins41:this.state.fixins41,
    }).then(res=>{

      //console.log(res.data);
      this.setState({
        defaultvarvalue41:this.state.fixins41,
        flagfixins41:0,
      })
    });
  }
  handleChangefixins41(e){
    //console.log(e.target.value);
    this.setState({
      fixins41:e.target.value,
    })
  }
  openfixins41()
  {
    this.setState({
      flagfixins41:1
    })
  }
  closefixins41()
  {
    this.setState({
      flagfixins41:0
    })
  }
  fixins41()
  {
    if(this.state.flagfixins41 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins41}><input onChange={this.handleChangefixins41} value={this.state.fixins41} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins41}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.defaultvarvalue41}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins41}>แก้ไข</span></div>
    }
  }
  handleSubmitfixins42(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins42',{
      id:this.props.id,
      fixins42:this.state.fixins42,
    }).then(res=>{
      //console.log(res.data);
      this.setState({
        defaultvarvalue42:this.state.fixins42,
        flagfixins42:0,
      })
    });
  }
  handleChangefixins42(e){
    //console.log(e.target.value);
    this.setState({
      fixins42:e.target.value,
    })
  }
  openfixins42()
  {
    this.setState({
      flagfixins42:1
    })
  }
  closefixins42()
  {
    this.setState({
      flagfixins42:0
    })
  }
  fixins42()
  {
    if(this.state.flagfixins42 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins42}><input onChange={this.handleChangefixins42} value={this.state.fixins42} class="form-control"/>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins42}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.defaultvarvalue42}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins42}>แก้ไข</span></div>
    }
  }

  handleSubmitfixins43(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/update/somecase?fixins43',{
      id:this.props.id,
      fixins43:this.state.day43+'/'+this.state.month43+'/'+this.state.year43,
    }).then(res=>{

      //console.log(res.data);
      this.setState({
        defaultvarvalue43:this.state.day43+'/'+this.state.month43+'/'+this.state.year43,
        flagfixins43:0,
      })
    });
  }
  handleChangefixins43(e){
    //console.log(e.target.value);
    this.setState({
      fixins43:e.target.value,
    })
  }
  openfixins43()
  {
    this.setState({
      flagfixins43:1
    })
  }
  closefixins43()
  {
    this.setState({
      flagfixins43:0
    })
  }
  fixins43(data)
  {
    if(this.state.flagfixins43 == 1)
    {
      return  <div> <form onSubmit={this.handleSubmitfixins43}>
      <select onChange={(e) => this.setState({ day43: e.target.value })} name="dayex">
      <option value ="">  วัน  </option>
      <option value ="01">  01  </option>
      <option value ="02">  02  </option>
      <option value ="03">  03  </option>
      <option value ="04">  04  </option>
      <option value ="05">  05  </option>
      <option value ="06">  06  </option>
      <option value ="07">  07  </option>
      <option value ="08">  08  </option>
      <option value ="09">  09  </option>          {
        this.state.day.map(
          data =>
          <option value={data}>{data}</option>
        )
        }
        </select>

        <select  onChange={(e) => this.setState({ month43: e.target.value })}>
        <option value ="">  เดือน  </option>
        <option value ="01">  01  </option>
        <option value ="02">  02  </option>
        <option value ="03">  03  </option>
        <option value ="04">  04  </option>
        <option value ="05">  05  </option>
        <option value ="06">  06  </option>
        <option value ="07">  07  </option>
        <option value ="08">  08  </option>
        <option value ="09">  09  </option>
        {
          this.state.month.map(
            data =>
            <option value={data}>{data}</option>
          )
          }
        </select>
      <select onChange={(e) => this.setState({ year43: e.target.value })}  >
      <option value ="">  ปี พ.ศ  </option>
      {
        this.state.year.map(
          data =>
          <option value={data}>{data}</option>
        )
        }
      </select>&nbsp;&nbsp;&nbsp;<button type="submit"  class="btn btn-box-tool" ><span style={{color:'green'}}>บันทึก</span></button><button type="button" onClick={this.closefixins43}class="btn btn-box-tool" ><span style={{color:'red'}}>ยกเลิก</span></button></form></div>
    }
    else
    {
      return <div ><span style={{float:'left'}}>{this.state.defaultvarvalue43}</span> <span  style={{float:'right',color:'orange'}}  onClick={this.openfixins43}>แก้ไข</span></div>
    }
  }
  insurancecopy()
  {
    if(this.props.filepublicname == null || this.props.filepublicname == '' ||this.props.filepublicname == 'undefined')
    {
      if(this.state.defaultvarvalue11 == null || this.state.defaultvarvalue11 == '' ||this.state.defaultvarvalue11 == 'undefined')
      {
        return  <th style={{backgroundColor:'white'}}><span style={{fontSize:'12px',color:'red'}}>ระบุวันที่{this.props.varname11}</span><br/><a disabled className="btn btn-default">อัพโหลด</a></th>
      }
      else
      {
        return  <th style={{backgroundColor:'white'}}>&nbsp;<a href={"https://erp.wealththai.net/SecurityBroke/case/uploadfile/"+this.props.id+"/xxx/CG4CG/Case_Attachment?cat?CA46CA/blink/wealththaiinsurance/file/upload/successblink"} target="_blank" className="btn btn-default">อัพโหลด</a></th>
      }
    }
    else
    {
      return  <th style={{backgroundColor:'white'}}>&nbsp; <a href={'/SecurityBroke/showfile/' + this.props.fileid} target="_blank">{this.props.filepublicname}</a></th>
    }
  }
    render() {
      return (
        <div className="column22" id="insuracedetail">
        <div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
        <div className="box-header  ">
          <b className="box-title" data-widget="collapse">กรมธรรมภาคสมัครใจ
</b>
<br/>
<br/>


       <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
       <thead>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
       <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >บริษัทประกันที่เลิอก</th>
        <th style={{backgroundColor:'white'}}>{this.props.companyname}</th>
       </tr>
       <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
       <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>Partner (Channel เดิม)</th>
        <th style={{backgroundColor:'white'}}>{this.props.partnername}</th>
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
        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>ไฟล์สำเนากรมธรรม์</th>
        {this.insurancecopy()}
        </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname11}</th>
          <th style={{backgroundColor:'white'}}>{this.fixins11()}</th>
        </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname52}</th>
          <th style={{backgroundColor:'white'}}>{this.fixins52()}</th>
        </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname14}</th>
          <th style={{backgroundColor:'white'}}>{this.fixins14()}</th>
        </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname41}</th>
          <th style={{backgroundColor:'white'}}>{this.fixins41()}</th>
        </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname42}</th>
          <th style={{backgroundColor:'white'}}>{this.fixins42()}</th>
        </tr>
         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>{this.props.varname43}</th>
          <th style={{backgroundColor:'white'}}>{this.fixins43()}</th>
        </tr>
        </thead>
        </table>
        </div>
        </div>
        </div>
        );
    }
}

if (document.getElementById('offerinsurance')) {
  const component = document.getElementById('offerinsurance');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<OfferInsurance {...props}/>, component);
}

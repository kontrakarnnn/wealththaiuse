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

export default class CaseSelectPortfolio extends Component {

  constructor(){
    super();
    //console.log(super());
    this.state = {
      showall:'box collapsed-box',
      portfolio:[],
      fixportflag:0,
      portname:'',
      portnumber:'',
      description:'',
      portid:'',
      defaultport:'',

    };
    this.clickfix = this.clickfix.bind(this);
    this.closefix = this.closefix.bind(this);
    this.openadd = this.openadd.bind(this);
    this.storenewport = this.storenewport.bind(this);
    this.storeporttocase = this.storeporttocase.bind(this);

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
    axios.get('/wealththaiinsurance/load/getcaseport/'+this.props.id).then(response=>{
      this.setState({portfolio:response.data});
    })
    this.setState({portname:this.props.customername+' '+this.props.customerlname,
                   portnumber:this.props.id,
                   defaultport:this.props.caseport,
                  })
  }
  clickfix()
  {
    this.setState({fixportflag:1});
  }
  closefix()
  {
    this.setState({fixportflag:0});
  }
  openadd()
  {
    this.setState({fixportflag:3});
  }
  storenewport(e)
  {
    e.preventDefault();
    axios.post('/wealththaiinsurance/store/portfolio',{
      id:this.props.id,
      portname:this.state.portname,
      portnumber:this.state.portnumber,
      description :this.state.description ,

    }).then(res=>{
      this.setState({portfolio:res.data,fixportflag:1});
    });

  }
  storeporttocase(e)
  {
    e.preventDefault();
    axios.post('/wealththaiinsurance/store/portfoliotocase',{
      id:this.props.id,
      portid:this.state.portid,
    }).then(res=>{
      this.setState({defaultport:res.data,fixportflag:0});
    });

  }
  showdetail()
  {
    if(this.state.fixportflag == 1)
    {
      return <div className="column2" id="casedetail">
                  <div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
                  <div className="box-header  ">
                  <form onSubmit={this.storeporttocase}>
                  <b className="box-title" >เลือกPortfolio &nbsp;</b>
                  <select className="form-control" onChange={(e) => this.setState({ portid: e.target.value })}><option>โปรดเลือก</option>{this.state.portfolio.map(data => <option value={data.id}>{data.type}</option>)}</select>
                  <br/><br/><button class="btn btn-success">บันทึก</button>&nbsp;&nbsp;
                  <button class="btn btn-danger" onClick={this.closefix}>ยกเลิก</button>&nbsp;&nbsp;
                  <button class="btn btn-info" onClick={this.openadd}>เพิ่ม</button>
                  </form>

                  </div>
                  </div>
                  </div>
    }
    else if(this.state.fixportflag == 3)
    {
      return <div className="column2" id="casedetail">
                  <div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
                  <div className="box-header  ">
                  <b className="box-title" >เพิ่ม Portfolio</b><br/><br/>
                  <form onSubmit={this.storenewport}>
                  <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'40px',textAlign:'center'}}>ชื่อ Portfolio</th>
                   <td style={{backgroundColor:'white'}}><input className="form-control" onChange={(e) => this.setState({ portname: e.target.value })} value={this.state.portname}/></td>
                  </tr>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'40px',textAlign:'center'}}>หมายเลข Portfolio </th>
                  <td style={{backgroundColor:'white'}}><input className="form-control"onChange={(e) => this.setState({ portnumber: e.target.value })} value={this.state.portnumber}/></td>
                  </tr>
                  <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                  <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'40px',textAlign:'center'}}>คำอธิบายเพิ่มเติม </th>
                  <td style={{backgroundColor:'white'}}><textarea className="form-control" onChange={(e) => this.setState({ description: e.target.value })} value={this.state.description}></textarea></td>
                  </tr>
                  </thead>
                  </table>
                  <button class="btn btn-success" >สร้าง</button>&nbsp;&nbsp;
                  <button class="btn btn-danger" type="button" onClick={this.closefix}>ยกเลิก</button>&nbsp;&nbsp;
                  </form>

                  </div>
                  </div>
                  </div>
    }
    else
    {
      return <div className="column2" id="casedetail">
                  <div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
                  <div className="box-header  ">
                  <b className="box-title" >Portfolio</b>
                  <select disabled className="form-control">{this.state.portfolio.map(data => <option value={data.id}  selected={this.state.defaultport == data.id ? 'selected' : ''}>{data.type}</option>)}</select>
                  <button class="btn btn-warning" onClick={this.clickfix}><i className="fa fa-gear"></i></button>
                  </div>
                  </div>
                  </div>
    }

  }
    render() {
      return (
          <div style={{height:'20px'}}>{this.showdetail()}</div>
        );
    }
}

if (document.getElementById('caseselectportfolio')) {
  const component = document.getElementById('caseselectportfolio');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<CaseSelectPortfolio {...props}/>, component);
}

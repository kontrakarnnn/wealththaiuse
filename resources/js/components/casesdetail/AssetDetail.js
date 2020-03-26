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

export default class AssetDetail extends Component {

  constructor(){
    super();
    //console.log(super());
    this.state = {
      showall:'box collapsed-box',
      caseassetcolumn:0,
    };
    this.columnchangecaseasset = this.columnchangecaseasset.bind(this);
    this.columnchangecaseassetdefault = this.columnchangecaseassetdefault.bind(this);

  }

  componentDidMount() {
    const url = window.location.href;
    if(url.includes('?mode=open') == true)
    {
        this.setState({caseassetcolumn:1});
    }
    else
    {
      this.setState({caseassetcolumn:0});
    }
  }
  columnchangecaseassetdefault()
  {
    this.setState({
      caseassetcolumn:0

    })
  }
  columnchangecaseasset()
  {
    this.setState({
      caseassetcolumn:1

    })
  }
  showassetdetail(){
      return <div >
                </div>


  }
  showdetail()
  {
    if(this.state.caseassetcolumn === 0)
    {
    return  <div className="column2" id="infoasset">
               <div className={this.state.showall} style={{backgroundColor:'#F5F5F5'}}>
               <div className="box-header  ">
                 <b className="box-title" >ข้อมูลสินทรัพย์</b>
                 <br/>
                 <br/>
                  <table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                             <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                            <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refnamehead}</th>
                              <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refname}</th>
                            </tr>
                            <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                           <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead3}</th>
                             <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo3}</th>
                           </tr>
                            <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                           <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}>  {this.props.refinfohead4}</th>
                             <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo4}</th>
                           </tr>
                           <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                          <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead5}</th>
                            <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo5}</th>
                          </tr>
                            </thead>
                  </table>
                 <div className="box-tools pull-right">
                   <button type="button" onClick={this.columnchangecaseasset} className="btn btn-box-tool" ><i className="fa fa-plus"></i></button>
                 </div>
               </div>

               </div>
               </div>
    }
    else
    {
    return <div className="column" id="infoasset">
              <div className="box " style={{backgroundColor:'#CDCDCD'}}>
              <div className="box-header  ">
                <b className="box-title" >ข้อมูลสินทรัพย์</b>
                <br/>
                <br/>
                <div className="box-tools pull-right">
                  <button type="button" className="btn btn-box-tool" onClick={this.columnchangecaseassetdefault} ><i className="fa fa-minus"></i></button>
                </div>
              </div>
              <div className="box-body"  >

              <div className="column3" ><table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
              <thead>


               <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                         <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >หมายเลขสินทรัพย์</th>
                           <th style={{backgroundColor:'white'}}>&nbsp;{this.props.assetid}</th>
                         </tr>
                          <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                         <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refnamehead}</th>
                           <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refname}</th>
                         </tr>
                         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead3}</th>
                          <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo3}</th>
                        </tr>
                        <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead6}</th>
                         <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo6}</th>
                        </tr>
                         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                        <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead4}</th>
                          <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo4}</th>
                        </tr>
                        <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                       <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead5}</th>
                         <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo5}</th>
                       </tr>
                        <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                       <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead8}</th>
                         <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo8}</th>
                       </tr>
                         </thead>
                         </table>
                         </div>
                         <div className="column3"><table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                         <thead>
                         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                         <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead1}</th>
                          <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo1}</th>
                         </tr>
                         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                         <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead2}</th>
                          <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo2}</th>
                         </tr>

                         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                         <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead7}</th>
                          <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo7}</th>
                         </tr>
                         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                         <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead9}</th>
                          <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo9}</th>
                         </tr>
                         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                         <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead10}</th>
                          <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo10}</th>
                         </tr>
                         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                         <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead11}</th>
                          <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo11}</th>
                         </tr>
                         <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                         <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead12}</th>
                          <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo12}</th>
                         </tr>
                                    </thead>
                                    </table>
                                    </div>
                                    <div className="column3"><table id="example2" className="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                    <thead>
                                    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                                    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead13}</th>
                                     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo13}</th>
                                    </tr>
                                    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                                    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead14}</th>
                                     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo14}</th>
                                    </tr>
                                    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                                    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead15}</th>
                                     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo15}</th>
                                    </tr>
                                    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                                    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead16}</th>
                                     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo16}</th>
                                    </tr>
                                    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                                    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead17}</th>
                                     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo17}</th>
                                    </tr>
                                    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                                    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >{this.props.refinfohead18}</th>
                                     <th style={{backgroundColor:'white'}}>&nbsp;{this.props.refinfo18}</th>
                                    </tr>
                                    <tr style={{border:'0.5px solid #E3E3E3',backgroundColor:'#F4F4F6'}}>
                                    <th style={{backgroundColor:'#F4F4F6',width:'50%',height:'70px',textAlign:'center'}}  >&nbsp;</th>
                                     <th style={{backgroundColor:'white'}}>&nbsp;</th>
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

if (document.getElementById('assetdetail')) {
  const component = document.getElementById('assetdetail');
  const props = Object.assign({}, component.dataset);
    ReactDOM.render(<AssetDetail {...props}/>, component);
}

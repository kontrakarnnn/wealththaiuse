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
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
pdfMake.vfs = pdfFonts.pdfMake.vfs;
pdfMake.fonts = {
  THSarabunNew: {
    normal: 'THSarabunNew.ttf',
    bold: 'THSarabunNew-Bold.ttf',
    italics: 'THSarabunNew-Italic.ttf',
    bolditalics: 'THSarabunNew-BoldItalic.ttf'
  },
  Roboto: {
    normal: 'Roboto-Regular.ttf',
    bold: 'Roboto-Medium.ttf',
    italics: 'Roboto-Italic.ttf',
    bolditalics: 'Roboto-MediumItalic.ttf'
  }
}
export default class LiquidityAsset extends Component {

  constructor(){
    super();
    ////console.log(super());
    this.state = {
      day:[],
      month:[],
      year:[],
      fromdateday:'',
      fromdatemonth:'',
      fromdateyear:'',
      todateday:'',
      todatemonth:'',
      todateyear:'',
      tableflag:0,
      cases:[],
      block:[],
      blockid:'',
      underblock:0,
      blockfilter:[],
      userauth:[],
      userinblock:[],
      blockcommission:[],
      structure:[],
      structureid:'',
      allblockcommission:'',
      blockarray:[],
    };

    this.Searchclick = this.Searchclick.bind(this);
    this.tableshow = this.tableshow.bind(this);
    this.Exportpdf = this.Exportpdf.bind(this);
    this.filterblockbystructure = this.filterblockbystructure.bind(this);

  }
  componentDidMount() {
      setInterval(() => this.forceUpdate(), 1000);
      axios.get('/wealththaiinsurance/report/getblock').then(response=>{
        this.setState({blockarray:response.data});
      })
      axios.get('/wealththaiinsurance/load/day').then(response=>{
        this.setState({day:response.data});
      })
      axios.get('/wealththaiinsurance/load/month').then(response=>{
        this.setState({month:response.data});
      })
      axios.get('/wealththaiinsurance/load/year?fromreportliquid').then(response=>{
        this.setState({year:response.data});
      })
      axios.get('/wealththaiinsurance/get/structure').then(response=>{
        this.setState({structure:response.data});
      })
  }
  tablerow()
  {
    return [ 'First', 'Second', 'Third', 'The last one' ],
    [ 'Value 1', 'Value 2', 'Value 3', 'Value 4' ],
    [ { text: 'Bold value', bold: true }, 'Val 2', 'Val 3', 'Val 4' ]
  }
  filterblockbystructure(e)
  {
    //console.log(e.target.value);
    this.state.block = this.state.blockarray.filter((block) => {
     return block.structure_id == e.target.value
   })  }
  Exportpdf()
  {
    var bodyData = [];
    bodyData.push([ {text:'No.',fillColor:'silver'}, {text:'LA/NLA',fillColor:'silver'}, {text:'Type',fillColor:'silver'}, {text:'Sub Type',fillColor:'silver'}, {text:'Asset Name',fillColor:'silver'}, {text:'Asset Referal Name',fillColor:'silver'}, {text:'Valid From',fillColor:'silver'}, {text:'Valid To',fillColor:'silver'}, {text:'Portfolio Name',fillColor:'silver'}, {text:'Customer Name',fillColor:'silver'}]);
    this.state.blockfilter.forEach((sourceRow,index) => {
      var dataRow = [];
    //  dataRow.push([ 'No.', 'Structure Name', 'Block Name', 'Belong To', 'User Name', 'Block Commission', '% Income'] )
      dataRow.push(++index);
      dataRow.push(sourceRow.la_nla);
      dataRow.push(sourceRow.assettype.la_nla_type);
      dataRow.push(sourceRow.assettype.nla_sub_type);
      dataRow.push(sourceRow.name);
      dataRow.push(sourceRow.ref_name);
      dataRow.push(sourceRow.valid_from);
      dataRow.push(sourceRow.valid_to);
      dataRow.push(sourceRow.portfolio.type);
      dataRow.push(sourceRow.portfolio.person.name+' '+sourceRow.portfolio.person.lname);
      bodyData.push(dataRow);
    });
    let header = "Liquidity Asset Report";
    let fromdatetodate = "ตั้งแต่วันที่ "+this.state.fromdateday+'/'+this.state.fromdatemonth+'/'+this.state.fromdateyear+' ถึงวันที่ '+this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear
    var docDefinition = {
      pageSize: 'A4',
      pageOrientation: 'landscape',
      content: [

    {text: header, fontSize: 15 ,alignment:'center'},
    {text: fromdatetodate, fontSize: 15 ,alignment:'center'},
    {

       table:{
                     headerRows: 1,
                     body:bodyData

                      }
          },
  ],

  defaultStyle:{font: 'THSarabunNew',
                fontSize: 15}
};
pdfMake.createPdf(docDefinition).open()
  }
  Searchclick()
  {
    axios.post('/wealththaiinsurance/report/getliquidityasset',{
      fromdate:this.state.fromdateday+'/'+this.state.fromdatemonth+'/'+this.state.fromdateyear,
      todate:this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear,
      blockid:this.state.blockid,
      underblock:this.state.underblock,
    }).then(res=>{
      //console.log(res.data);

      if(res.data <= 0)
      {
        this.setState({
          tableflag:2
        })
      }
      else
      {
        this.setState({
          blockfilter:res.data,
          tableflag:1
        })
      }
      //console.log('Block',this.state.blockfilter);
    });
    }

  tableshow()
  {
    if(this.state.tableflag == 0)
    {
      return <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row">
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No. </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">LA/NLA</th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Type</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Sub Type</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Asset Name</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Asset Referal Name</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Valid From </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Valid To</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Portfolio Name</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Customer Name</th>


              </tr>
          </thead>
          <tbody>

          </tbody>

          </table>
    }
    else if (this.state.tableflag == 1)
    {
      return <div> <ReactHTMLTableToExcel
                    id="test-table-xls-button"
                    className="download-table-xls-button"
                    table="table-to-xls"
                    filename="team_perfomance_report"
                    sheet="tablexls"
                    buttonText="Export as Excel"/>&nbsp;
                    <button onClick={this.Exportpdf}>Export as PDF </button>

                    <table id="table-to-xls" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row" class="pagebreak">
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No. </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">LA/NLA</th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Type</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Sub Type</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Asset Name</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Asset Referal Name</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Valid From </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Valid To</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Portfolio Name</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Customer Name</th>

              </tr>
          </thead>
          <tbody>
          {
          this.state.blockfilter.map(
            (data,index) =>
          <tr>
          <td>{++index}</td>
          <td>{data.la_nla}</td>
          <td>{data.assettype.la_nla_type}</td>
          <td>{data.assettype.nla_sub_type}</td>
          <td>{data.name}</td>
          <td>{data.ref_name}</td>
          <td>{data.valid_from}</td>
          <td>{data.valid_to}</td>
          <td>{data.portfolio.type}</td>
          <td>{data.portfolio.person.name} {data.portfolio.person.lname}</td>


          </tr>
          )}


          </tbody>

          </table>

          </div>
    }
    else if(this.state.tableflag == 2)
    {
      return <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row">
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No. </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">LA/NLA</th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Type</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Sub Type</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Asset Name</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Asset Referal Name</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Valid From </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Valid To</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Portfolio Name</th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Customer Name</th>

              </tr>
          </thead>
          <tbody>
          <tr>
          <td colspan="6" style={{textAlign:'center',color:'red',fontSize:'18px'}}><b>ไม่พบข้อมูล</b></td>
          </tr>
          </tbody>
          <tfoot>
          <tr>
          <th colspan=""> </th>
          <th colspan="" > </th>
          <th colspan="" > </th>
          <th colspan=""> </th>
          <th colspan=""> </th>
          <th colspan=""> </th>
          <th colspan="" > </th>
          <th colspan="" > </th>
          <th colspan=""> </th>
          <th colspan=""> </th>
          </tr>
          </tfoot>
          </table>
    }
  }
    render() {
      return (
            <div>
            <div class="row">
            <div class="column4">
            <div class="card">
            <div class="card-header">
            <b>จากวันที่</b>
            </div>
            <div class="card-body">
            <select class="form-control" onChange={(e) => this.setState({ fromdateday: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" >  01  </option>
        <option value ="02" >  02  </option>
        <option value ="03" >  03  </option>
        <option value ="04" >  04  </option>
        <option value ="05" >  05  </option>
        <option value ="06" >  06  </option>
        <option value ="07" >  07  </option>
        <option value ="08" >  08  </option>
        <option value ="09" >  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} >{data}</option>
          )
          }
          </select>

          <select  class="form-control" onChange={(e) => this.setState({ fromdatemonth: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  >  01  </option>
          <option value ="02"  >  02  </option>
          <option value ="03"  >  03  </option>
          <option value ="04"  >  04  </option>
          <option value ="05"  >  05  </option>
          <option value ="06"  >  06  </option>
          <option value ="07"  >  07  </option>
          <option value ="08"  >  08  </option>
          <option value ="09"  >  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  >{data}</option>
            )
            }
          </select>
        <select class="form-control" onChange={(e) => this.setState({ fromdateyear: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  >{data}</option>
          )
          }
        </select>
        <br/><br/>
        &nbsp;
            </div>
            </div>
            </div>
            <div class="column4">
            <div class="card">
            <div class="card-header">
            <b>ถึงวันที่</b>
            </div>
            <div class="card-body">
            <select class="form-control" onChange={(e) => this.setState({ todateday: e.target.value })} name="dayex">
        <option value ="">  วัน  </option>
        <option value ="01" >  01  </option>
        <option value ="02" >  02  </option>
        <option value ="03" >  03  </option>
        <option value ="04" >  04  </option>
        <option value ="05" >  05  </option>
        <option value ="06" >  06  </option>
        <option value ="07" >  07  </option>
        <option value ="08" >  08  </option>
        <option value ="09" >  09  </option>          {
          this.state.day.map(
            data =>
            <option value={data} >{data}</option>
          )
          }
          </select>

          <select  class="form-control" onChange={(e) => this.setState({ todatemonth: e.target.value })}>
          <option value ="">  เดือน  </option>
          <option value ="01"  >  01  </option>
          <option value ="02"  >  02  </option>
          <option value ="03"  >  03  </option>
          <option value ="04"  >  04  </option>
          <option value ="05"  >  05  </option>
          <option value ="06"  >  06  </option>
          <option value ="07"  >  07  </option>
          <option value ="08"  >  08  </option>
          <option value ="09"  >  09  </option>
          {
            this.state.month.map(
              data =>
              <option value={data}  >{data}</option>
            )
            }
          </select>
        <select class="form-control" onChange={(e) => this.setState({ todateyear: e.target.value })}  >
        <option value ="">  ปี พ.ศ  </option>
        {
          this.state.year.map(
            data =>
            <option value={data}  >{data}</option>
          )

          }
        </select>
        <br/><br/>
        &nbsp;
            </div>
            </div>
            </div>
            <div class="column4">
            <div class="card">
            <div class="card-header">
            <b>เลือกStructure</b>
            </div>
            <div class="card-body">
            <select class="form-control " id="autowidth"  onChange={this.filterblockbystructure}>
            <option>กรุณาเลือก</option>
            {
              this.state.structure.map(
                data =>
                <option value={data.id}  >{data.name}</option>
              )
            }
              </select><br/><br/>        &nbsp;

            </div>
            </div>
            </div>
            <div class="column4">
            <div class="card">
            <div class="card-header">
            <b>เลือกทีม</b>
            </div>
            <div class="card-body">
            <select class="form-control " id="autowidth"  onChange={(e) => this.setState({ blockid: e.target.value })}>
            <option>กรุณาเลือกทีม</option>
            {
              this.state.block.map(
                data =>
                <option value={data.id}  >{data.name}</option>
              )
            }
              </select><br/><br/>
              ดูทุกทีมที่อยู่ภายใต้ทีมนี <select onChange={(e) => this.setState({ underblock: e.target.value })}><option value="0">ไม่</option><option value="1">ใช่</option></select>
            </div>
            </div>
            </div>


            </div>
            <button style={{float:'right'}} type="submit" class="btn btn-primary" onClick={this.Searchclick}>
              <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
              ค้นหา
            </button><br/><br/>
            <div style={{overflowX:'auto'}}>
            {this.tableshow()}
            </div>

            </div>
        );
    }
}

if (document.getElementById('liquidityasset')) {
    ReactDOM.render(<LiquidityAsset />, document.getElementById('liquidityasset'));
}

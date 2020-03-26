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
export default class DistributionInsight extends Component {

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
      casechannel:[],
      process:[],
      finish:[],
      cancel:[],
      total:[],
      percentfinish:'',
      averagepercent:[],

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
      axios.get('/wealththaiinsurance/load/year?fromreport').then(response=>{
        this.setState({year:response.data});
      })
      axios.get('/wealththaiinsurance/get/structure').then(response=>{
        this.setState({structure:response.data});
      })
      axios.get('/wealththaiinsurance/load/casechannel').then(response=>{
        this.setState({casechannel:response.data});
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
    bodyData.push([ {text:'No.',fillColor:'silver'}, {text:'Channel',fillColor:'silver'}, {text:'Process',fillColor:'silver'}, {text:'Cancel',fillColor:'silver'}, {text:'Finish',fillColor:'silver'}, {text:'total',fillColor:'silver'}, {text:'% Finish',fillColor:'silver'}]);
    this.state.casechannel.forEach((sourceRow,index) => {
      var dataRow = [];
    //  dataRow.push([ 'No.', 'Structure Name', 'Block Name', 'Belong To', 'User Name', 'Block Commission', '% Income'] )
      dataRow.push(++index);
      dataRow.push(sourceRow.name);
      dataRow.push(this.caseprocesspdf(sourceRow));
      dataRow.push(this.casecancelpdf(sourceRow));
      dataRow.push(this.casefinishpdf(sourceRow));
      dataRow.push(this.totalcasepdf(sourceRow));
      dataRow.push(this.percentfinishpdf(sourceRow));
      bodyData.push(dataRow)
    });
    bodyData.push([ '', {text:'Total Number of Block',fillColor:'green'}, this.state.casechannel.length,'','', '', '']);
    let header = "Distribution Insight Report"
    let fromdatetodate = "ตั้งแต่วันที่ "+this.state.fromdateday+'/'+this.state.fromdatemonth+'/'+this.state.fromdateyear+' ถึงวันที่ '+this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear
    var docDefinition = {
      pageSize: 'A4',
      pageOrientation: 'protait',
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
                fontSize: 15,
            }
};
pdfMake.createPdf(docDefinition).open()
  }
  Searchclick()
  {
    axios.post('/wealththaiinsurance/report/filterblock',{
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
    axios.post('/wealththaiinsurance/report/filterreturncase',{
      fromdate:this.state.fromdateday+'/'+this.state.fromdatemonth+'/'+this.state.fromdateyear,
      todate:this.state.todateday+'/'+this.state.todatemonth+'/'+this.state.todateyear,
      blockid:this.state.blockid,
      underblock:this.state.underblock,
    }).then(response=>{
      this.setState({
        cases:response.data,
      })

      //console.log("yes"+response.data);
      //console.log('Cases',this.state.cases);
      //console.log('process',this.state.process);

    });



    }

    showcaseincomeinblock(data)
    {
      let income = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == data.id
     })
     let sumall;
     let ans;
     let result = [];
     let sum= income.map(data =>result.push(data.offer.offer_payment_value19));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
     }
     else
     {
        sumall = 0;
     }
      ans = sumall/this.state.allblockcommission*100;
      if(ans == "Infinity")
      {
        return <td>0</td>
      }
      else if(ans == "NaN")
      {
        return <td>0</td>
      }
      else
      {
        return <td>{ans}%</td>;

      }
    }
    showcasecominblockpdf(sourceRow)
    {
      this.state.blockcommission = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == sourceRow.id
     })
     let sumall;
     let result = [];
     let sum= this.state.blockcommission.map(data =>result.push(data.offer.offer_payment_value19));
     if(result.length>0)
     {

        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
     }
     else
     {
        sumall = 0;
     }
     return sumall;
    }
    showcasecominblockpdf(sourceRow)
    {
      this.state.blockcommission = this.state.cases.filter((cases) => {
       return cases.cases.service_user_block_id == sourceRow.id
     })
     let sumall;
     let result = [];
     let sum= this.state.blockcommission.map(data =>result.push(data.offer.offer_payment_value19));
     if(result.length>0)
     {
        sumall =  result.reduce((result2,number)=> Number(result2)+Number(number));
     }
     else
     {
        sumall = 0;
     }
     return sumall;
    }

    showuserinblockpdf(data)
    {
      this.state.userinblock = this.state.userauth.filter((userauth) => {
       return userauth.block_id == data.id
     })
     if(this.state.userinblock == null ||this.state.userinblock == 0 ||this.state.userinblock == '' )
     {
       return " "
     }
     else
     {
       return this.state.userinblock.map(name =>name.user.firstname )
     }
    }
    showunderblockpdf(sourceRow)
    {
      if(sourceRow.under_block == null ||sourceRow.under_block == 0 ||sourceRow.under_block == '' )
      {
        return ""

      }
      else
      {
        if(sourceRow.belongtoblock.name == sourceRow.name )
        {
          return {text:sourceRow.belongtoblock.name,fillColor:'silver'}

        }
        return {text:sourceRow.belongtoblock.name,fillColor:''}

      }
    }
  showunderblock(data)
  {
    if(data.under_block == null ||data.under_block == 0 ||data.under_block == '' )
    {
      return <td></td>

    }
    else
    {
      return <td>{data.belongtoblock.name}</td>

    }
  }
  caseprocesspdf(data)
  {
    this.state.process = this.state.cases.filter(fil => {
    return fil.case_channel.id == data.id && fil.case_status.id == 1 ;
  }) ;
  return this.state.process.length
  }
  casecancelpdf(data)
  {
    this.state.cancel = this.state.cases.filter(fil => {
    return fil.case_channel.id == data.id && fil.case_status.id == 3 ;
  }) ;
  return this.state.cancel.length
  }
  casefinishpdf(data)
  {
    this.state.finish = this.state.cases.filter(fil => {
    return fil.case_channel.id == data.id && fil.case_status.id == 2 ;
  }) ;
  return this.state.finish.length
  }
  totalcasepdf(data)
  {
    this.state.total = this.state.cases.filter(fil => {
    return fil.case_channel.id == data.id ;
  }) ;
  return this.state.total.length
  }
  percentfinishpdf(data)
  {
    this.state.finish = this.state.cases.filter(fil => {
    return fil.case_channel.id == data.id && fil.case_status.id == 2 ;
  }) ;
  this.state.total = this.state.cases.filter(fil => {
  return fil.case_channel.id == data.id ;
}) ;
    this.state.percentfinish = Number(this.state.finish.length) *  Number(this.state.total.length)/100
    this.state.percentfinish = this.state.percentfinish.toFixed(2);

  return this.state.percentfinish
  }

  caseprocess(data)
  {
    this.state.process = this.state.cases.filter(fil => {
    return fil.case_channel.id == data.id && fil.case_status.id == 1 ;
  }) ;
  return this.state.process.length
  }
  casecancel(data)
  {
    this.state.cancel = this.state.cases.filter(fil => {
    return fil.case_channel.id == data.id && fil.case_status.id == 3 ;
  }) ;
  return this.state.cancel.length
  }
  casefinish(data)
  {
    this.state.finish = this.state.cases.filter(fil => {
    return fil.case_channel.id == data.id && fil.case_status.id == 2 ;
  }) ;
  return this.state.finish.length
  }
  totalcase(data)
  {
    this.state.total = this.state.cases.filter(fil => {
    return fil.case_channel.id == data.id ;
  }) ;
  return this.state.total.length
  }
  percentfinish(data)
  {
    this.state.finish = this.state.cases.filter(fil => {
    return fil.case_channel.id == data.id && fil.case_status.id == 2 ;
  }) ;
  this.state.total = this.state.cases.filter(fil => {
  return fil.case_channel.id == data.id ;
}) ;
    this.state.percentfinish = Number(this.state.finish.length) *  Number(this.state.total.length)/100
    this.state.percentfinish = this.state.percentfinish.toFixed(2);
  return this.state.percentfinish
  }
  tableshow()
  {
    if(this.state.tableflag == 0)
    {
      return <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row">
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No. </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Channel</th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Process </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Cancel </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Finish </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">total </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Finish </th>
              </tr>
          </thead>
          <tbody>
          <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>

          <td></td>
          <td></td>

          <td></td>
          </tr>



          </tbody>
          <tfoot>
          <tr>
          <th colspan=""> </th>
          <th colspan="" style={{backgroundColor:'green'}}> Total Number of Block</th>
          <th colspan="" > </th>
          <th></th>
          <th colspan="" > </th>
          <th colspan=""> </th>
          <th colspan=""> </th>
          </tr>
          </tfoot>
          </table>
    }
    else if (this.state.tableflag == 1)
    {

      return <div> <ReactHTMLTableToExcel
                    id="test-table-xls-button"
                    className="download-table-xls-button"
                    table="table-to-xls"
                    filename="tablexls"
                    sheet="tablexls"
                    buttonText="Export as Excel"/>&nbsp;
                    <button onClick={this.Exportpdf}>Export as PDF </button>

                    <table id="table-to-xls" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row" class="pagebreak">
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No. </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Channel</th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Process </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Cancel </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Finish </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">total </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Finish </th>

              </tr>
          </thead>
          <tbody>
          {
          this.state.casechannel.map(
            (data,index) =>
          <tr>
          <td>{++index}</td>
          <td>{data.name}</td>
          <td>{this.caseprocess(data)}</td>
          <td>{this.casecancel(data)}</td>
          <td>{this.casefinish(data)}</td>
          <td>{this.totalcase(data)}</td>
          <td class="percentfin" >{this.percentfinish(data)}%</td>
          </tr>
          )}


          </tbody>
          <tfoot>
          <tr class="pagebreak">
          <th colspan=""> </th>
          <th colspan="" style={{backgroundColor:'green'}}> Total Number of Channel</th>
          <th colspan="" >{this.state.casechannel.length}</th>
          <th> </th>
          <th colspan="" ></th>
          <th colspan=""></th>
          <th colspan=""></th>
          </tr>
          </tfoot>
          </table>

          </div>
    }
    else if(this.state.tableflag == 2)
    {
      return <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
          <tr role="row">
          <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">No. </th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Channel</th>
            <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Process </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Cancel </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">Finish </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">total </th>
              <th   tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">% Finish </th>
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
          <th colspan="" style={{backgroundColor:'green'}}> Total Number of Block</th>
          <th colspan="" > </th>
          <th ></th>
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

if (document.getElementById('distributioninsight')) {
    ReactDOM.render(<DistributionInsight />, document.getElementById('distributioninsight'));
}

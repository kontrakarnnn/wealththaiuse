import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import ReactTable from 'react-table'
import 'react-table/react-table.css'
import Picky from 'react-picky';
import 'react-picky/dist/picky.css'; // Include CSS
export default class Insuranceoffer extends Component {

  constructor(){
    super();
    //console.log(super());
    this.state = {
      alloffer:[],
      proposal:[],
      flagaddproposal:0,
      partnerblock:[],
      proposalname:'',
      partnerblockid:'',
      partnerblockname:'',
      description:'',
      proposalnameError:'',
      successmessage:'',
      proposalid:'',
      flagopeneditprop:0,

    };
    this.autoload = this.autoload.bind(this);
    this.addproposal = this.addproposal.bind(this);
    this.handleChangeProposalname = this.handleChangeProposalname.bind(this);
    this.handleSubmitProposal = this.handleSubmitProposal.bind(this);
    this.handleChangePartnerblock = this.handleChangePartnerblock.bind(this);
    this.handleChangeProposaldescription = this.handleChangeProposaldescription.bind(this);
    this.validateproposal = this.validateproposal.bind(this);
    this.resetsuccesstext = this.resetsuccesstext.bind(this);
    this.handleclick = this.handleclick.bind(this);
    this.editCliente = this.editCliente.bind(this);
    this.handleEditProposal = this.handleEditProposal.bind(this);

  }

  componentDidMount(){

    axios.get('/wealththaiinsurance/load/partner').then(response=>{
      this.setState({partnerblock:response.data});
    })
    this.autoload();
  //  setInterval(this.autoload, 10000);

  }
  handleEditProposal(e){
    e.preventDefault();
    const isValid = this.validateproposal();
    console.log(isValid);
    if(isValid === false){

    }
    else{
          axios.post('/wealththaiinsurance/update/proposal',{
          proposalid:this.state.proposalid,
          proposalname:this.state.proposalname,
          partnerblockid:this.state.partnerblockid,
          description:this.state.description,
        }).then(res=>{
          this.setState({
            proposal:res.data,
            successmessage:'เปลี่ยนแปลงข้อมูลเรียบร้อยแล้ว',

          })
        });

      }
  }
  editCliente(data) {
    this.state.flagopeneditprop = 1;
    this.setState({proposalname:data.name,
                   partnerblockid:data.partner_block.id,
                   partnerblockname:data.partner_block.name,
                   description:data.description,
                   proposalid:data.id,
                   successmessage:''
                 });
}
showeditform()
{

    return <div class="content">
    <form onSubmit={this.handleEditProposal}>

    <table class="table  table-hover" >
    <tr>
    <th width=""><p>ชื่อ</p></th>
    <th ><input class="form-control"
    onChange={this.handleChangeProposalname}
    value={this.state.proposalname}
    /><br/><span style={{color:'red',fontSize:'12px'}}>{this.state.proposalnameError}</span></th>
    </tr>
    <tr>
    <th width=""><p></p></th>
    <th ></th>
    </tr>
    <tr>
    <th width=""><p>ผู้ให้คำปรึกษา/Partner</p></th>
    <th style={{width:'200px'}}>        <Picky
      value={this.state.partnerblockname}
      options={this.state.partnerblock}
      onChange={this.handleChangePartnerblock}
      //open={true}
      valueKey="id"
      labelKey="name"
      //includeSelectAll={true}
      includeFilter={true}
      dropdownHeight={200}
      placeholder="โปรดเลือก"
      numberDisplayed ={1}
      filterPlaceholder=""
      tabIndex={104}
      filterPlaceholder=""
                     /></th>
    </tr>
    <tr>
    <th width=""><p></p></th>
    <th ></th>
    </tr>
    <tr>
    <th width=""><p>รายละเอียดเพิ่มเติม</p></th>
    <th ><textarea class="form-control"
    onChange={this.handleChangeProposaldescription}
    value={this.state.description}
    ></textarea></th>
    </tr>

    </table>
    <button class="btn btn-success btn-margin" type="submit">บันทึก</button>
    <button class="btn btn-danger btn-margin"  data-dismiss="modal">ออก</button>

    </form>
    </div>
}
  handleclick(e){
    console.log(e);
    this.setState({proposalid:e});
    console.log(this.state.proposalid)
  }
  showcase(data){
    if(data.cases === null || data.cases === '')
    {
      return <p></p>
    }
    else
    {
      return <p>{data.cases.name}</p>
    }
  }
  showpartner(data){
    if(data.partner_block === null || data.partner_block === '')
    {
      return <p></p>
    }
    else
    {
      return <p>{data.partner_block.name}</p>
    }
  }
  resetsuccesstext()
  {
    this.setState({
      successmessage:'',
      proposalname:'',
      partnerblockid:'',
      partnerblockname:'',
      description:'',
      proposalnameError:'',
    })
  }
  handleChangePartnerblock(e){
    console.count('onChange')
        console.log("Val", e.id);
        this.setState({ partnerblockid: e.id,partnerblockname:e });
  }


  handleChangeProposalname(e){
    console.log(e.target.value);
    this.setState({
      proposalname:e.target.value,
    })
    if(this.state.proposalname !== ''){
      this.setState({
        proposalnameError:'',
      })    }
  }
  handleChangeProposaldescription(e){
    console.log(e.target.value);
    this.setState({
      description:e.target.value,
    })
  }

  autoload()
  {
    axios.get('/wealththaiinsurance/load/proposal').then(response=>{
        this.setState({proposal:response.data});
          console.log('proposal');
      }).catch(errors=>{
        console.log(errors);
      })
    axios.get('/wealththaiinsurance/alloffer/load').then(response=>{
      this.setState({alloffer:response.data});
        console.log('alloffer');
    }).catch(errors=>{
      console.log(errors);
    })

  }
  addproposal()
  {
    this.setState({flagaddproposal:1});
    console.log(this.state.flagaddproposal);
  }
  handleSubmitProposal(e){
    e.preventDefault();
    const isValid = this.validateproposal();
    console.log(isValid);
    if(isValid === false){

    }
    else{
          axios.post('/wealththaiinsurance/store/proposal',{
          proposalname:this.state.proposalname,
          partnerblockid:this.state.partnerblockid,
          description:this.state.description,
        }).then(res=>{

          this.setState({
            proposal:res.data,
            successmessage:'เพิ่มข้อมูลเรียบร้อยแล้ว',
            proposalname:'',
            partnerblockname:'',
            partnerblockid:'',
            description:'',
          })
        });

      }
  }
  validateproposal(){
    let proposalnameError ='';
  if(this.state.proposalname === null || this.state.proposalname === '' || this.state.proposalname === ' '){
      proposalnameError ="กรุณาตั้งชื่อ";
    }


    if(proposalnameError){
      this.setState({
        proposalnameError
      });
      return false;
    }
    return true;
  }
  addproposalform()
  {
    return
  }
    render() {

      return (
            <div>
              <div style={{overflowX:'auto'}}>
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">

                <th  colspan="100"  > <button type="button" class="btn btn-primary btn-margin" onClick={this.resetsuccesstext} data-toggle="modal" data-target="#myModal">Add Proposal</button><div class="modal " id="myModal" role="dialog">
                  <div class="modal-dialog " ><div class="modal-content">
                  <div class="modal-header" >Add New Proposal                      <span setTimeout="2000" style={{color:'green',fontSize:'14px',textAlign:'center'}}>{this.state.successmessage}</span>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div><div class="tab-content" style={{padding:'10px'}}>
                      <div class="content">
                      <form onSubmit={this.handleSubmitProposal}>

                      <table class="table  table-hover" >
                      <tr>
                      <th width=""><p>ชื่อ</p></th>
                      <th ><input class="form-control"
                      onChange={this.handleChangeProposalname}
                      value={this.state.proposalname}
                      /><br/><span style={{color:'red',fontSize:'12px'}}>{this.state.proposalnameError}</span></th>
                      </tr>
                      <tr>
                      <th width=""><p></p></th>
                      <th ></th>
                      </tr>
                      <tr>
                      <th width=""><p>ผู้ให้คำปรึกษา/Partner</p></th>
                      <th style={{width:'200px'}}>        <Picky
                        value={this.state.partnerblockname}
                        options={this.state.partnerblock}
                        onChange={this.handleChangePartnerblock}
                        //open={true}
                        valueKey="id"
                        labelKey="name"
                        //includeSelectAll={true}
                        includeFilter={true}
                        dropdownHeight={200}
                        placeholder="โปรดเลือก"
                        numberDisplayed ={1}
                        filterPlaceholder=""
                        tabIndex={104}
                        filterPlaceholder=""
                                       /></th>
                      </tr>
                      <tr>
                      <th width=""><p></p></th>
                      <th ></th>
                      </tr>
                      <tr>
                      <th width=""><p>รายละเอียดเพิ่มเติม</p></th>
                      <th ><textarea class="form-control"
                      onChange={this.handleChangeProposaldescription}
                      value={this.state.description}
                      ></textarea></th>
                      </tr>

                      </table>
                      <button class="btn btn-success btn-margin" type="submit">บันทึก</button>
                      <button class="btn btn-danger btn-margin"  data-dismiss="modal">ออก</button>

                      </form>
                      </div>

 </div>
 </div>
 </div>
 </div>

 </th>


                </tr>

                  <tr role="row">
                  <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ชื่อ </th>
                  <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">สร้างโดย </th>
                  <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">สร้างวันที่ </th>
                  <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ผู้ให้คำปรึกษา </th>
                  <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ชื่องาน </th>
                  <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">รายละเอียดเพิ่มเติม </th>
                    <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending"></th>
                  </tr>
                </thead>
                <tbody>
                {this.state.proposal.map(data =>
                <tr role="row" class="odd">
                      <th >{data.name}</th>
                      <th>{data.match_id.public_name}</th>
                      <th>{data.created_date}</th>
                      <th>{this.showpartner(data)}</th>
                      <th>{this.showcase(data)}</th>
                      <th>{data.description}</th>
                      <th><button class="btn btn-warning btn-margin"onClick={this.editCliente.bind(this, data)} data-toggle="modal" data-target="#myModal2">แก้ไข</button>
                      <div class="modal " id="myModal2" role="dialog"><div class="modal-dialog " ><div class="modal-content">
                     <div class="modal-header" >Add New Proposal                      <span setTimeout="2000" style={{color:'green',fontSize:'14px',textAlign:'center'}}>{this.state.successmessage}</span>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div><div class="tab-content" style={{padding:'10px'}}>

                     {this.showeditform()}

                 </div>
                 </div>
                 </div>
                 </div>
                      </th>
                    </tr>
  )}
                    </tbody>


        </table></div>
              <div style={{overflowX:'auto'}}>
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                <th  colspan="100"  >   <a href="/admin/offer/create?prev/wealththaiinsurance/all/offerproposal"  class="btn btn-primary btn-margin">Add Offer</a> <a  class="btn btn-primary btn-margin">Create Quotation</a></th>
                </tr>
                  <tr role="row">
                  <th  colspan="8"  > ข้อเสนอทั้งหมด</th>
                  <th  colspan="9"  >มูลค่าเบี้ย</th>
                  </tr>
                  <tr role="row">
                  <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">เลือกรายการ </th>
                    <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ชื่อข้อเสนอ </th>
                    <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">ประเภทข้อเสนอ</th>
                    <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">วันที่สร้าง</th>
                    <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">วันที่แก้ไขล่าสุด</th>
                    <th  aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">คนสร้าง  </th>
                    <th    aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">บริษัท</th>
                    <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">สาขา</th>
                    <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">**เบี้ยสุทธิ	</th>
                    <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">**อากรแสตมป์	</th>
                    <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">**ภาษีมุลค่าเพิ่ม	</th>
                    <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">**เบี้ยหน้าตั๋วตามใบเสร็จรับเงิน	</th>
                    <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">**ยอดหัก ณ ที่จ่าย	</th>
                    <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">**รูปแบบการคำนวณ	</th>
                    <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">**ค่าใช้จ่ายสุทธิที่ผู้แจ้งงานต้องจ่าย	</th>
                    <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending">**ค่าใช้จ่ายสุทธิที่โอนไปบริษัทประกัน	</th>
                    <th   aria-controls="example2" rowspan="1" colspan="1" aria-label="port: activate to sort column ascending"></th>


                  </tr>
                </thead>
                <tbody>
                {this.state.alloffer.map(data =>
                <tr title="Meeting Date Missed"role="row" class="odd">
                  <th style={{textAlign:'center'}}><input type="checkbox" onChange={this.handleSelectOffer} value={data.id} /></th>
                      <th >{data.name}</th>
                      <th>{data.offer_type.name}</th>
                      <th>{data.created_date}</th>
                      <th>{data.modified_date}</th>
                      <th>{data.match_id.public_name}</th>
                      <th>{data.person.name}</th>
                      <th>{data.branch.name}</th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>

                      <th></th>
                      <th></th>
                      <th><a class="btn btn-warning btn-margin" href={'/admin/offer/'+data.id+'/edit?prev/wealththaiinsurance/all/offerproposal'}>แก้ไข</a><button type="button" class="btn btn-info btn-margin" data-toggle="modal" data-target={"#myModal"+data.id}>รายละเอียด</button><div class="modal " id={"myModal"+data.id} role="dialog">
                        <div class="modal-dialog modal-lg" ><div class="modal-content">
                        <div class="modal-header" >


                        </div><div class="tab-content" style={{padding:'10px'}}>
                          <div id={"home"+data.id} class="tab-pane  in active">
                            <h3>รายละเอียดข้อเสนอ</h3>
                            <table class="table table-bordered table-hover" >

                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name1} </p></th>
                            <th >{data.offer_value1}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name2} </p></th>
                            <th >{data.offer_value2}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name3} </p></th>
                            <th >{data.offer_value3}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name4} </p></th>
                            <th >{data.offer_value4}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name5} </p></th>
                            <th >{data.offer_value5}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name6} </p></th>
                            <th >{data.offer_value6}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name7} </p></th>
                            <th >{data.offer_value7}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name8} </p></th>
                            <th >{data.offer_value8}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name9} </p></th>
                            <th >{data.offer_value9}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name10} </p></th>
                            <th >{data.offer_value10}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name11} </p></th>
                            <th >{data.offer_value11}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name12} </p></th>
                            <th >{data.offer_value12}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name13} </p></th>
                            <th >{data.offer_value13}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name14} </p></th>
                            <th >{data.offer_value14}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name15} </p></th>
                            <th >{data.offer_value15}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name16} </p></th>
                            <th >{data.offer_value16}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name17} </p></th>
                            <th >{data.offer_value17}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name18} </p></th>
                            <th >{data.offer_value18}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name19} </p></th>
                            <th >{data.offer_value19}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name20} </p></th>
                            <th >{data.offer_value20}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name21} </p></th>
                            <th >{data.offer_value21}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name22} </p></th>
                            <th >{data.offer_value22}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name23} </p></th>
                            <th >{data.offer_value23}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name24} </p></th>
                            <th >{data.offer_value24}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name25} </p></th>
                            <th >{data.offer_value25}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name26} </p></th>
                            <th >{data.offer_value26}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name27} </p></th>
                            <th >{data.offer_value27}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name28} </p></th>
                            <th >{data.offer_value28}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name29} </p></th>
                            <th >{data.offer_value29}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name30} </p></th>
                            <th >{data.offer_value30}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name31} </p></th>
                            <th >{data.offer_value31}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name32} </p></th>
                            <th >{data.offer_value32}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name33} </p></th>
                            <th >{data.offer_value33}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name34} </p></th>
                            <th >{data.offer_value34}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name35} </p></th>
                            <th >{data.offer_value35}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name36} </p></th>
                            <th >{data.offer_value36}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name37} </p></th>
                            <th >{data.offer_value37}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name38} </p></th>
                            <th >{data.offer_value38}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name39} </p></th>
                            <th >{data.offer_value39}</th>
                            </tr>
                            <tr>
                            <th width=""><p>{data.offer_type.offer_value_name40} </p></th>
                            <th >{data.offer_value40}</th>
                            </tr>
                            </table>
                            </div>
                            </div>
                            </div></div></div>
                            </th>



                    </tr>
                  )}
                    </tbody>


        </table></div></div>
        );
    }
}

if (document.getElementById('insuranceoffer')) {
    ReactDOM.render(<Insuranceoffer />, document.getElementById('insuranceoffer'));
}

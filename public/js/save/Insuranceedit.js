import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import DatePicker from 'react-datepicker';
import moment from 'moment';
import 'react-datepicker/dist/react-datepicker.css';
import Select from 'react-select';
import Picky from 'react-picky';
import 'react-picky/dist/picky.css'; // Include CSS
export default class Insuranceedit extends Component {

  constructor(){
    super();
    //console.log(super());
    this.state = {
      news:[],
      user:[],
      userid:'',
      coordinator:[],
      coordinate:[],
      coordinateid:'',
      partner:[],
      partnerid:'',
      casechannel:[],
      casechannelid:'',
      name:'',
      lname:'',
      email:'',
      mobile:'',
      nickname:'',
      memberfile:[],
      country_code:'',
      member:[],
      memberid:'',
      memberprofile:[],
      membercar:[],
      asset:'',
      assetid:'',
      assetdetail:[],
      assetfile:[],
      addmemberflag:0,
      membertype:[],
      membertypeid:'',
      gender:'',
      noadressflag:0,
      day:[],
      month:[],
      year:[],
      dayex:'',
      monthex:'',
      yearex:'',
      daybi:'',
      monthbi:'',
      yearbi:'',
      citizenid:'',
      add1:'',
      add1alley:'',
      add1road:'',
      add1subdistrict:'',
      add1district:'',
      add1city:'',
      add1country:'',
      add1postcode:'',
      add1tel:'',
      add1fax:'',
      add2:'',
      add2alley:'',
      add2road:'',
      add2subdistrict:'',
      add2district:'',
      add2city:'',
      add2country:'',
      add2postcode:'',
      add2tel:'',
      add2fax:'',
      country:[],
      city:[],
      district:[],
      subdistrict:[],
      emailflag:'',
      emailError:'',
      citizenidError:'',
      user:[],
      coordinate:[],
      addassetflag:0,
      assettype:[],
      issuer:[],
      issuerid:'',
      assetname:'',
      refname:'',
      ref_number1:'',
      ref_number2:'',
      ref_number3:'',
      ref_info1:'',
      ref_info2:'',
      ref_info3:'',
      ref_info4:'',
      ref_info5:'',
      ref_info6:'',
      ref_info7:'',
      ref_info8:'',
      ref_info9:'',
      ref_info10:'',
      ref_info11:'',
      ref_info12:'',
      ref_info13:'',
      ref_info14:'',
      ref_info15:'',
      ref_info16:'',
      ref_info17:'',
      ref_info18:'',
      issued_by:'',
      amount:'',
      assetvalue:'',
      cost:'',
      validfromday:'',
      validfrommonth:'',
      validfromyear:'',
      validtoday:'',
      validtomonth:'',
      validtoyear:'',
      contact_pid:'',
      note:'',
      reloadmemfileflag:0,
      reloadassetfileflag:0,
      casecategory:[],
      casetype:[],
      casesubtype:[],
      casename:'',
      casecategoryid:'',
      casetypeid:'',
      casesubtypeid:'',
      membercaseowner:'',
      requirevalue1:'',
      requirevalue2:'',
      requirevalue3:'',
      requirevalue4:'',
      requirevalue5:'',
      requirevalue6:'',
      requirevalue7day:'',
      requirevalue7month:'',
      requirevalue7year:'',
      requirevalue8day:'',
      requirevalue8month:'',
      requirevalue8year:'',
      requirevalue9day:'',
      requirevalue9month:'',
      requirevalue9year:'',
      requirevalue10:'',
      requirevalue11:'',
      requirevalue12:'',
      requirevalue13:'',
      requirevalue14:'',
      requirevalue15:'',
      requirevalue16:'',
      requirevalue17:'',
      requirevalue18:'',
      requirevalue19:'',
      requirevalue20:'',
      requirevar1:'โปรดเลือกชนิดของรายงาน',
      requirevar2:'โปรดเลือกชนิดของรายงาน',
      requirevar3:'โปรดเลือกชนิดของรายงาน',
      requirevar4:'โปรดเลือกชนิดของรายงาน',
      requirevar5:'โปรดเลือกชนิดของรายงาน',
      requirevar6:'โปรดเลือกชนิดของรายงาน',
      requirevar7:'โปรดเลือกชนิดของรายงาน',
      requirevar8:'โปรดเลือกชนิดของรายงาน',
      requirevar9:'โปรดเลือกชนิดของรายงาน',
      requirevar10:'โปรดเลือกชนิดของรายงาน',
      requirevar11:'โปรดเลือกชนิดของรายงาน',
      requirevar12:'โปรดเลือกชนิดของรายงาน',
      requirevar13:'โปรดเลือกชนิดของรายงาน',
      requirevar14:'โปรดเลือกชนิดของรายงาน',
      requirevar15:'โปรดเลือกชนิดของรายงาน',
      requirevar16:'โปรดเลือกชนิดของรายงาน',
      requirevar17:'โปรดเลือกชนิดของรายงาน',
      requirevar18:'โปรดเลือกชนิดของรายงาน',
      requirevar19:'โปรดเลือกชนิดของรายงาน',
      requirevar20:'โปรดเลือกชนิดของรายงาน',
      requirevar20:'',
      memberpid:[],
      more:'',
      couple_email:'',
      belongtopidmember:'',
      flagrecheck:0,
      hidediv:'columnhide',
      showdiv:'',
      successdiv:'columnhide',
      notsuccessdiv:'',
      username:'โปรดเลือก',
      partnername:'โปรดเลือก',
      coorname:'โปรดเลือก',
      assurance:[],
      assurancename:[],
      assurancenameedit:[],
      publicid:[],
      guildmember:[],
      groupmember:[],
      grouppid:[],
      grouppartner:[],
      publicname:[],
      partnername2:[],
      username2:[],
      guildmembername:[],
      groupmembername:[],
      grouppidname:[],
      grouppartnername:[],
      contactdetail:'',
      caseedit:[],
      membername:'',
      memberlname:'',
      companyflag:0,
      caseid:'',
    };

    this.handleChangeCasename = this.handleChangeCasename.bind(this);
    this.handleChangeRequirevalue1 = this.handleChangeRequirevalue1.bind(this);
    this.handleChangeRequirevalue2 = this.handleChangeRequirevalue2.bind(this);
    this.handleChangeRequirevalue3 = this.handleChangeRequirevalue3.bind(this);
    this.handleChangeRequirevalue4 = this.handleChangeRequirevalue4.bind(this);
    this.handleChangeRequirevalue5 = this.handleChangeRequirevalue5.bind(this);
    this.handleChangeRequirevalue6 = this.handleChangeRequirevalue6.bind(this);
    this.handleChangeRequirevalue7 = this.handleChangeRequirevalue7.bind(this);
    this.handleChangeRequirevalue8 = this.handleChangeRequirevalue8.bind(this);
    this.handleChangeRequirevalue9 = this.handleChangeRequirevalue9.bind(this);
    this.handleChangeRequirevalue10 = this.handleChangeRequirevalue10.bind(this);
    this.handleChangeRequirevalue11 = this.handleChangeRequirevalue11.bind(this);
    this.handleChangeRequirevalue12 = this.handleChangeRequirevalue12.bind(this);
    this.handleChangeRequirevalue13 = this.handleChangeRequirevalue13.bind(this);
    this.handleChangeRequirevalue14 = this.handleChangeRequirevalue14.bind(this);
    this.handleChangeRequirevalue15 = this.handleChangeRequirevalue15.bind(this);
    this.handleChangeRequirevalue16 = this.handleChangeRequirevalue16.bind(this);
    this.handleChangeRequirevalue17 = this.handleChangeRequirevalue17.bind(this);
    this.handleChangeRequirevalue18 = this.handleChangeRequirevalue18.bind(this);
    this.handleChangeRequirevalue19 = this.handleChangeRequirevalue19.bind(this);
    this.handleChangeRequirevalue20 = this.handleChangeRequirevalue20.bind(this);
    this.handleChangeCasetype = this.handleChangeCasetype.bind(this);

    this.handleChangeCost = this.handleChangeCost.bind(this);
    this.handleChangeAssetvalue = this.handleChangeAssetvalue.bind(this);
    this.handleChangeNote = this.handleChangeNote.bind(this);
    this.handleChangeCost = this.handleChangeCost.bind(this);
    this.handleChangeAssetvalue = this.handleChangeAssetvalue.bind(this);

    this.handleChangeNote = this.handleChangeNote.bind(this);
    this.handleChangeCost = this.handleChangeCost.bind(this);
    this.handleChangeAssetvalue = this.handleChangeAssetvalue.bind(this);
    this.handleChangeAmount = this.handleChangeAmount.bind(this);
    this.handleChangeRefinfo1 = this.handleChangeRefinfo1.bind(this);
    this.handleChangeRefinfo2 = this.handleChangeRefinfo2.bind(this);
    this.handleChangeRefinfo3 = this.handleChangeRefinfo3.bind(this);
    this.handleChangeRefinfo4 = this.handleChangeRefinfo4.bind(this);
    this.handleChangeRefinfo5 = this.handleChangeRefinfo5.bind(this);
    this.handleChangeRefinfo6 = this.handleChangeRefinfo6.bind(this);
    this.handleChangeRefinfo7 = this.handleChangeRefinfo7.bind(this);
    this.handleChangeRefinfo8 = this.handleChangeRefinfo8.bind(this);
    this.handleChangeRefinfo9 = this.handleChangeRefinfo9.bind(this);
    this.handleChangeRefinfo10 = this.handleChangeRefinfo10.bind(this);
    this.handleChangeRefinfo11 = this.handleChangeRefinfo11.bind(this);
    this.handleChangeRefinfo12 = this.handleChangeRefinfo12.bind(this);
    this.handleChangeRefinfo13 = this.handleChangeRefinfo13.bind(this);
    this.handleChangeRefinfo14 = this.handleChangeRefinfo14.bind(this);
    this.handleChangeRefinfo15 = this.handleChangeRefinfo15.bind(this);
    this.handleChangeRefinfo16 = this.handleChangeRefinfo16.bind(this);
    this.handleChangeRefinfo17 = this.handleChangeRefinfo17.bind(this);
    this.handleChangeRefinfo18 = this.handleChangeRefinfo18.bind(this);
    this.handleChangeRefnumber1 = this.handleChangeRefnumber1.bind(this);
    this.handleChangeRefnumber2 = this.handleChangeRefnumber2.bind(this);
    this.handleChangeRefnumber3 = this.handleChangeRefnumber3.bind(this);
    this.handleChangeAssetname = this.handleChangeAssetname.bind(this);
    this.handleChangeRefname = this.handleChangeRefname.bind(this);
    this.handleChangeCitizenid = this.handleChangeCitizenid.bind(this);
    this.handleChangeMemberid = this.handleChangeMemberid.bind(this);
    this.handleChangeAssetdtail = this.handleChangeAssetdtail.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleSubmitflag = this.handleSubmitflag.bind(this);
    this.handleChange = this.handleChange.bind(this);
    this.handleChangeAsset = this.handleChangeAsset.bind(this);
    this.handleSubmitAsset = this.handleSubmitAsset.bind(this);
    this.handleSubmitNewAsset = this.handleSubmitNewAsset.bind(this);
    this.handleChangeLname = this.handleChangeLname.bind(this);
    this.handleChangeNname = this.handleChangeNname.bind(this);
    this.handleChangeAdd1 = this.handleChangeAdd1.bind(this);
    this.handleChangeAdd1alley = this.handleChangeAdd1alley.bind(this);
    this.handleChangeAdd1road = this.handleChangeAdd1road.bind(this);
    this.handleChangeAdd1subdistrict = this.handleChangeAdd1subdistrict.bind(this);
    this.handleChangeAdd1district = this.handleChangeAdd1district.bind(this);
    this.handleChangeAdd1city = this.handleChangeAdd1city.bind(this);
    this.handleChangeAdd1country = this.handleChangeAdd1country.bind(this);
    this.handleChangeAdd1postcode = this.handleChangeAdd1postcode.bind(this);
    this.handleChangeAdd1tel = this.handleChangeAdd1tel.bind(this);
    this.handleChangeAdd1fax = this.handleChangeAdd1fax.bind(this);
    this.handleChangeAdd2 = this.handleChangeAdd2.bind(this);
    this.handleChangeAdd2alley = this.handleChangeAdd2alley.bind(this);
    this.handleChangeAdd2road = this.handleChangeAdd2road.bind(this);
    this.handleChangeAdd2subdistrict = this.handleChangeAdd2subdistrict.bind(this);
    this.handleChangeAdd2district = this.handleChangeAdd2district.bind(this);
    this.handleChangeAdd2city = this.handleChangeAdd2city.bind(this);
    this.handleChangeAdd2country = this.handleChangeAdd2country.bind(this);
    this.handleChangeAdd2postcode = this.handleChangeAdd2postcode.bind(this);
    this.handleChangeAdd2tel = this.handleChangeAdd2tel.bind(this);
    this.handleChangeAdd2fax = this.handleChangeAdd2fax.bind(this);
    this.openaddmember = this.openaddmember.bind(this);
    this.closeaddmember = this.closeaddmember.bind(this);
    this.openaddasset = this.openaddasset.bind(this);
    this.closeaddasset = this.closeaddasset.bind(this);
    this.handleChangeName = this.handleChangeName.bind(this);
    this.handleChangeEmail = this.handleChangeEmail.bind(this);
    this.handleChangeMobile = this.handleChangeMobile.bind(this);
    this.handleChangeMembertype = this.handleChangeMembertype.bind(this);
    this.handleChangeGender = this.handleChangeGender.bind(this);
    this.NorenderAddress = this.NorenderAddress.bind(this);
    this.Noadress = this.Noadress.bind(this);
    this.handleshowaddress = this.handleshowaddress.bind(this);
    this.handleChangeDayEx = this.handleChangeDayEx.bind(this);
    this.dayrxpi = this.dayrxpi.bind(this);
    this.handleSubmitMember = this.handleSubmitMember.bind(this);
    this.handlecheckemail = this.handlecheckemail.bind(this);
    this.validatemember = this.validatemember.bind(this);
    this.renderComponentAddress = this.renderComponentAddress.bind(this);
    this.handleLoadmemberfile = this.handleLoadmemberfile.bind(this);
    this.handleLoadassetfile = this.handleLoadassetfile.bind(this);
    this.handleSubmitcase = this.handleSubmitcase.bind(this);
    this.Changeclass = this.Changeclass.bind(this);
    this.Changedefault = this.Changedefault.bind(this);
    this.Showcase = this.Showcase.bind(this);
    this.Showrequire3 = this.Showrequire3.bind(this);
    this.Showrequire4 = this.Showrequire4.bind(this);
    this.Showrequire6 = this.Showrequire6.bind(this);
    this.Step1to2btn = this.Step1to2btn.bind(this);
    this.handleChangePublicname = this.handleChangePublicname.bind(this);
    this.handleChangePartnername = this.handleChangePartnername.bind(this);
    this.handleChangeUsername = this.handleChangeUsername.bind(this);
    this.handleChangeGuildmembername = this.handleChangeGuildmembername.bind(this);
    this.handleChangeGroupmembername = this.handleChangeGroupmembername.bind(this);
    this.handleChangeGrouppidname = this.handleChangeGrouppidname.bind(this);
    this.handleChangeGrouppartnername = this.handleChangeGrouppartnername.bind(this);
    this.checkcontactdetail = this.checkcontactdetail.bind(this);
    this.companyflagopen = this.companyflagopen.bind(this);
    this.companyflagclose = this.companyflagclose.bind(this);

  }
  componentDidMount(){
    let url = window.location.href;
    let id = url.split("/");
    let caseeditid = id[6];
    let checkurl = caseeditid.indexOf('#step3');
    if(checkurl > 0)
    {
       caseeditid = caseeditid.split("#step3");
       caseeditid = caseeditid[0];
    }
    console.log('this'+caseeditid);
    this.setState({caseid:caseeditid});
    axios.get('/wealththaiinsurance/load/casecat').then(response=>{
      this.setState({casecategory:response.data});

    })
    axios.get('/wealththaiinsurance/load/casetype').then(response=>{
      this.setState({casetype:response.data});

    })
    axios.get('/wealththaiinsurance/load/casesubtype').then(response=>{
      this.setState({casesubtype:response.data});

    })
    axios.get('/wealththaiinsurance/load/user').then(response=>{
      this.setState({user:response.data});
    })
    axios.get('/wealththaiinsurance/load/coordinate').then(response=>{
      let coorfil = response.data.filter((coordinator) => {
        return coordinator.block_id == 72
      })
      this.setState({coordinate:coorfil});
    })

    axios.get('/wealththaiinsurance/load/partner').then(response=>{
      this.setState({partner:response.data});
    })

    axios.get('/wealththaiinsurance/load/member').then(response=>{
      this.setState({member:response.data});
    })
        axios.get('/wealththaiinsurance/load/editcase?filtercase'+caseeditid).then(response=>{
          let datere7 = response.data.require_value7;
          datere7 = datere7.split("/");
          let req7day = datere7[0];
          let req7month = datere7[1];
          let req7year = datere7[2];
          let date = response.data.require_value8;
          date = date.split("/");
          let req8day = date[0];
          let req8month = date[1];
          let req8year = date[2];
          let datere9 = response.data.require_value9;
          datere9 = datere9.split("/");
          let req9day = datere9[0];
          let req9month = datere9[1];
          let req9year = datere9[2];

          this.setState({
                          caseedit:response.data,casename:response.data.name,casetypeid:response.data.type_id,casesubtypeid:response.data.sub_type_id,
                          userid:response.data.service_user_block_id,
                          caseid:caseeditid,
                          membername:response.data.person.name,
                          memberlname:response.data.person.lname,
                          casecategoryid:response.data.case_type.case_cat_id,
                          partnerid:response.data.default_partner_block_id,
                          casetypeid:response.data.type_id,
                          coordinateid:response.data.coordinate_user_block_id,
                          casechannelid:response.data.case_channel.id,
                          memberid:response.data.member_case_owner,
                          assetid:response.data.referal_asset,
                          requirevar1:response.data.case_type.requirename_var1,
                          requirevar2:response.data.case_type.requirename_var2,
                          requirevar3:response.data.case_type.requirename_var3,
                          requirevar4:response.data.case_type.requirename_var4,
                          requirevar5:response.data.case_type.requirename_var5,
                          requirevar6:response.data.case_type.requirename_var6,
                          requirevar7:response.data.case_type.requirename_var7,
                          requirevar8:response.data.case_type.requirename_var8,
                          requirevar9:response.data.case_type.requirename_var9,
                          requirevar10:response.data.case_type.requirename_var10,
                          requirevar11:response.data.case_type.requirename_var11,
                          requirevar12:response.data.case_type.requirename_var12,
                          requirevar13:response.data.case_type.requirename_var13,
                          requirevar14:response.data.case_type.requirename_var14,
                          requirevar15:response.data.case_type.requirename_var15,
                          requirevar16:response.data.case_type.requirename_var16,
                          requirevar17:response.data.case_type.requirename_var17,
                          requirevar18:response.data.case_type.requirename_var18,
                          requirevar19:response.data.case_type.requirename_var19,
                          requirevar20:response.data.case_type.requirename_var20,
                          requirevalue1:response.data.require_value1,
                          requirevalue2:response.data.require_value2,
                          requirevalue3:response.data.require_value3,
                          requirevalue4:response.data.require_value4,
                          requirevalue5:response.data.require_value5,
                          requirevalue6:response.data.require_value6,
                          requirevalue7:response.data.require_value7,
                          requirevalue8:response.data.require_value8,
                          assurancenameedit:response.data.require_value10,
                          requirevalue7day:req7day,
                          requirevalue7month:req7month,
                          requirevalue7year:Number(req7year)+Number(543),
                          requirevalue8day:req8day,
                          requirevalue8month:req8month,
                          requirevalue8year:Number(req8year)+Number(543),
                          requirevalue9day:req9day,
                          requirevalue9month:req9month,
                          requirevalue9year:Number(req9year)+Number(543),
                          requirevalue9:response.data.require_value9,
                          requirevalue10:response.data.require_value10,
                          requirevalue11:response.data.require_value11,
                          requirevalue12:response.data.require_value12,
                          requirevalue13:response.data.require_value13,
                          requirevalue14:response.data.require_value14,
                          requirevalue15:response.data.require_value15,
                          requirevalue16:response.data.require_value16,
                          requirevalue17:response.data.require_value17,
                          requirevalue18:response.data.require_value18,
                          requirevalue19:response.data.require_value19,
                          requirevalue20:response.data.require_value20,

                        });
                        console.log(`Option selected:`,response.data.case_channel.id);
                        axios.get('/wealththaiinsurance/choose/memberasset?fileterassetid'+response.data.referal_asset,{
                        }).then(response2=>{

                          console.log('assetdetail'+response2.data);
                          this.setState({
                            assetdetail:response2.data
                          })
                        }).catch(errors=>{
                          console.log(errors);
                        });

                        axios.get('/wealththaiinsurance/choose/memberassetfile?fileterassetid'+response.data.referal_asset,{
                        }).then(response3=>{

                          console.log(response3.data);
                          this.setState({
                            assetfile:response3.data

                          })
                        }).catch(errors=>{
                          console.log(errors);
                        });
                        //console.log(e.target.value);
                          if(response.data.type_id != '')
                          {

                          }
                        else{
                            this.state.partnerid = 0;
                            this.state.partnername = "โปรดเลือก";
                            this.state.userid = 0;
                            this.state.username = "โปรดเลือก";
                            this.state.requirevar1 = "โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar2="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar3="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar4="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar5="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar6="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar7="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar8="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar9="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar10="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar11="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar12="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar13="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar14="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar15="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar16="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar17="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar18="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar19="โปรดเลือกชนิดของรายงาน";
                            this.state.requirevar20="โปรดเลือกชนิดของรายงาน";
                        }

        })
    axios.get('/wealththaiinsurance/load/casechannel').then(response=>{
      this.setState({casechannel:response.data});
    })
    axios.get('/wealththaiinsurance/load/publicid').then(response=>{
      this.setState({publicid:response.data});

    })
    axios.get('/wealththaiinsurance/load/guildmember').then(response=>{
      this.setState({guildmember:response.data});

    })
    axios.get('/wealththaiinsurance/load/groupmember').then(response=>{
      this.setState({groupmember:response.data});

    })
    axios.get('/wealththaiinsurance/load/grouppid').then(response=>{
      this.setState({grouppid:response.data});

    })
    axios.get('/wealththaiinsurance/load/grouppartner').then(response=>{
      this.setState({grouppartner:response.data});

    })

    axios.get('/wealththaiinsurance/load/day').then(response=>{
      this.setState({day:response.data});
    })
    axios.get('/wealththaiinsurance/load/membertype').then(response=>{
      this.setState({membertype:response.data});
    })
    axios.get('/wealththaiinsurance/load/month').then(response=>{
      this.setState({month:response.data});
    })
    axios.get('/wealththaiinsurance/load/year').then(response=>{
      this.setState({year:response.data});
    })
    axios.get('/wealththaiinsurance/load/country').then(response=>{
      this.setState({country:response.data});
    })
    axios.get('/wealththaiinsurance/load/city').then(response=>{
      this.setState({city:response.data});
    })
    axios.get('/wealththaiinsurance/load/subdistrict').then(response=>{
      this.setState({subdistrict:response.data});
    })
    axios.get('/wealththaiinsurance/load/district').then(response=>{
      this.setState({district:response.data});
    })
    axios.get('/wealththaiinsurance/load/memberpid').then(response=>{
      this.setState({memberpid:response.data});

    })

    axios.get('/wealththaiinsurance/load/assettype').then(response=>{
      this.setState({assettype:response.data});

    })
    axios.get('/wealththaiinsurance/load/issuer').then(response=>{
      this.setState({issuer:response.data});

    })

    axios.get('/wealththaiinsurance/load/assurance').then(response=>{
      this.setState({assurance:response.data});

    })

  }
  companyflagopen()
  {
  this.setState({companyflag:1});
  }
  companyflagclose()
  {
  this.setState({companyflag:0});
  }
  companyarrayshow()
  {
    if(this.state.companyflag == 0)
    {
      return <div>{this.state.requirevalue10}  <button type="button" onClick={this.companyflagopen}>แก้ไข</button></div>
    }
    else
    {
      return <div style={{width: '190px'}}><Picky
        value={this.state.assurancename}
        options={this.state.assurance}
        onChange={this.handleChangeRequirevalue10}
        //open={true}
        valueKey="name"
        labelKey="name"
        multiple={true}
        //includeSelectAll={true}
        includeFilter={true}
        dropdownHeight={300}
        numberDisplayed ={1}
        filterPlaceholder=""
        />
        <button type="button" onClick={this.companyflagclose}>ยกเลิก</button>
        </div>
    }
  }

checkcontactdetail(e)
{
  console.log(e.target.checked );
  let namelname = '';
  let mobile = '';
  let email = '';
  let addsentdoc ='';
  let add = '';
  let addalley = '';
  let addroad = '';
  let addsubdistrict = '';
  let adddistrict = '';
  let addcity = '';
  let addprovince = '';
  let addpostcode = '';
  let line = '';

  if(e.target.checked === true)
  {
    this.state.memberprofile.map(function(memberprofile){
      namelname = memberprofile.name + ' ' + memberprofile.lname;
      mobile = memberprofile.mobile;
      email = memberprofile.email;
      add = memberprofile.add2;
      addalley = memberprofile.add2_alley;
      addroad = memberprofile.add2_road;
      addsubdistrict = memberprofile.add2_subdistrict;
      adddistrict = memberprofile.add2_district;
      addcity = memberprofile.add2_city;
      addprovince = memberprofile.add2_country;
      addpostcode = memberprofile.add2_postcode;
      line = memberprofile.lineid;

      //mobile = memberprofile.mobile;

      });
      if(add == null){add = '-'}if(addalley == null){addalley = '-'}if(addroad == null){addroad = '-'}if(addsubdistrict == null){addsubdistrict = '-'}
      if(adddistrict == null){adddistrict = '-'}if(addcity == null){addcity = '-'}if(addprovince == null){addprovince = '-'}if(addpostcode == null){addpostcode = '-'}
      console.log(this.state.memberprofile);
      this.setState({ requirevalue16: namelname,
                      requirevalue17: mobile,
                      requirevalue18: email,
                      requirevalue19: 'เลขที่ '+add+' ซอย '+addalley+' ถนน '+addroad+' แขวง '+addsubdistrict+' เขต '+adddistrict+' จังหวัด '+addcity+' ประเทศ '+addprovince+' รหัสไปรษณีย์ '+addpostcode ,
                      requirevalue20: line
                    });
  }
  else
  {
    this.setState({ requirevalue16: '',requirevalue17: '',requirevalue18: '',requirevalue19: '',requirevalue20: '' });  }
  /*this.state.memberprofile.map(function(memberprofile){
    type = memberprofile.type;

  });*/
}
  handleChangePublicname(e){
    console.count('onChange')
        console.log("Val", e);
        this.setState({ publicname: e });
  }
  handleChangePartnername(e){
    console.count('onChange')
        console.log("Val", e);
        this.setState({ partnername2: e });
  }
  handleChangeUsername(e){
    console.count('onChange')
        console.log("Val", e);
        this.setState({ username2: e });
  }
  handleChangeGuildmembername(e){
    console.count('onChange')
        console.log("Val", e);
        this.setState({ guildmembername: e });
  }
  handleChangeGroupmembername(e){
    console.count('onChange')
        console.log("Val", e);
        this.setState({ groupmembername: e });
  }
  handleChangeGrouppidname(e){
    console.count('onChange')
        console.log("Val", e);
        this.setState({ grouppidname: e });
  }
  handleChangeGrouppartnername(e){
    console.count('onChange')
        console.log("Val", e);
        this.setState({ grouppartnername: e });
  }
  MemberorOrganization()
  {
    let type = "";
    this.state.memberprofile.map(function(memberprofile){
      type = memberprofile.type;

    });

    if(type == 2)
    {
      return <div>{
        this.state.memberprofile.map(
          data => <table>
      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th>ชื่อบริษัท</th>
      <td>{data.name} {data.lname}</td>
      </tr>
      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th>ประเภทธุรกิจ</th>
      <td>{data.more}</td>
      </tr>
      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th>วันที่จดทะเบียน</th>
      <td>{data.dob}</td>
      </tr>
      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th>เลขที่นิติบุคคล</th>
      <td>{data.id_num}</td>
      </tr>
      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th>บริษัทสัญชาติ</th>
      <td>{data.nationality}</td>
      </tr>

      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th >ที่อยู่บริษัท</th>
      <td>{data.add2} {data.add2_alley} {data.add2_road} {data.add2_subdistrict} {data.add2_district} {data.add2_city} {data.add2_country} {data.add2_postcode}</td>
      </tr>

      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th >เบอร์โทรศัพท์</th>
      <td >{data.mobile}</td>
      </tr>
      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th >อีเมล</th>
      <td >{data.email}</td>
      </tr>
      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th >แฟกซ์</th>
      <td >{data.add2_fax}</td>
      </tr>
      <br/>
    </table>
  )}
    </div>;
    }
    else
    {
      return <div>{
        this.state.memberprofile.map(
          data => <table>
      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th>ชื่อ</th>
      <td>{data.name} {data.lname}</td>
      </tr>
      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th >ที่อยู่ตามบัตร</th>
      <td>เลขที่ {data.add1} ซอย {data.add1_alley} ถนน {data.add1_road} แขวง {data.add1_subdistrict} เขต {data.add1_district} จังหวัด {data.add1_city} ประเทศ {data.add1_country} รหัสไปรษณีย์ {data.add1_postcode}</td>
      </tr>
      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th>ที่อยู่จัดส่งเอกสาร</th>
      <td>เลขที่ {data.add2} ซอย {data.add2_alley} ถนน {data.add2_road} แขวง {data.add2_subdistrict} เขต {data.add2_district} จังหวัด {data.add2_city} ประเทศ {data.add2_country} รหัสไปรษณีย์ {data.add2_postcode}</td>
      </tr>
      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th >เบอร์โทรศัพท์</th>
      <td >{data.mobile}</td>
      </tr>
      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th >อีเมล</th>
      <td >{data.email}</td>
      </tr>
      <tr><th></th><td>&nbsp;</td></tr>
      <tr>
      <th >แฟกซ์</th>
      <td >{data.add1_fax}</td>
      </tr>
      <br/>
    </table>
  )}
    </div>


    }
  }

  Step2to3nav()
  {
    if(this.state.memberprofile != '' && this.state.assetdetail != '' ){
      return   <li role="presentation" >
          <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3 รายละเอียดงาน">
              <span class="round-tab">
                <i class="glyphicon glyphicon-glyphicon glyphicon-briefcase"></i>

              </span>
          </a>
      </li>
    }
    else if(this.state.memberprofile == 0 || this.state.assetdetail == 0)
    {
      return <li role="presentation" class="disabled">
          <a  title="Step 3 รายละเอียดงาน">
              <span class="round-tab">
                <i class="glyphicon glyphicon-glyphicon glyphicon-briefcase"></i>

              </span>
          </a>
      </li>;

    }
    else{
      return <li role="presentation" class="disabled">
          <a  title="Step 3 รายละเอียดงาน">
              <span class="round-tab">
                <i class="glyphicon glyphicon-glyphicon glyphicon-briefcase"></i>

              </span>
          </a>
      </li>;
    }
  }
  Step2to3btn()
  {
    if(this.state.memberprofile != '' && this.state.assetdetail != '' ){
      return <a href="#step3" class="btn btn-primary btn-margin" data-toggle="tab" aria-controls="step3" role="tab">ต่อไป</a>

    }
    else if(this.state.memberprofile == 0 || this.state.assetdetail == 0)
    {
      return '';

    }
    else{
      return '';
    }
  }
  Step1to2nav()
  {
    if(this.state.casecategoryid != '' && this.state.casetypeid != '' && this.state.casesubtypeid != '' && this.state.casename != '' && this.state.userid != '' && this.state.coordinateid != '' && this.state.partnerid != '' && this.state.casechannelid != ''){
      return  <li role="presentation" >
          <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2 ผู้เอาประกัน">
              <span class="round-tab">
                  <i class="glyphicon glyphicon-user"></i>

              </span>
          </a>
      </li>
    }
    else if(this.state.casecategoryid == 0 || this.state.casetypeid == 0 || this.state.casesubtypeid == 0 ||  this.state.userid == 0 && this.state.coordinateid == 0 && this.state.partnerid == 0 && this.state.casechannelid == 0)
    {
      return <li role="presentation" class="disabled">
          <a title="Step 2 ผู้เอาประกัน">
              <span class="round-tab">
                  <i class="glyphicon glyphicon-user"></i>

              </span>
          </a>
      </li>;

    }
    else{
      return <li role="presentation" class="disabled">
          <a title="Step 2 ผู้เอาประกัน">
              <span class="round-tab">
                  <i class="glyphicon glyphicon-user"></i>

              </span>
          </a>
      </li>;
    }
  }
  Step1to2btn()
  {
    if(this.state.casecategoryid != '' && this.state.casetypeid != '' && this.state.casesubtypeid != '' && this.state.casename != '' && this.state.userid != ''  && this.state.casechannelid != ''){
      return <div style={{float:'left'}}><a  href="#step2" class="btn btn-primary btn-margin" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2 ผู้เอาประกัน">ต่อไป</a>&nbsp;</div>

    }
    else if(this.state.casecategoryid == 0 || this.state.casetypeid == 0 || this.state.casesubtypeid == 0 ||  this.state.userid == 0 && this.state.coordinateid == 0 && this.state.partnerid == 0 && this.state.casechannelid == 0)
    {
      return '';

    }
    else{
      return '';
    }
  }
  Showrequire6()
  {
    if(this.state.requirevalue6 == "ทำ")
    {
      return                <tr>
                            <th >{this.state.requirevar9}</th>
                            <td ><div style={{width: '190px'}}>
                            <div style={{display: 'inline-block'}}>
                            <select onChange={(e) => this.setState({ requirevalue9day: e.target.value })} name="dayex">
                            <option value ="">  วัน  </option>
                            <option value ="01" selected={this.state.requirevalue9day == '01' ? 'selected' : ''}>  01  </option>
                            <option value ="02" selected={this.state.requirevalue9day == '02' ? 'selected' : ''}>  02  </option>
                            <option value ="03" selected={this.state.requirevalue9day == '03' ? 'selected' : ''}>  03  </option>
                            <option value ="04" selected={this.state.requirevalue9day == '04' ? 'selected' : ''}>  04  </option>
                            <option value ="05" selected={this.state.requirevalue9day == '05' ? 'selected' : ''}>  05  </option>
                            <option value ="06" selected={this.state.requirevalue9day == '06' ? 'selected' : ''}>  06  </option>
                            <option value ="07" selected={this.state.requirevalue9day == '07' ? 'selected' : ''}>  07  </option>
                            <option value ="08" selected={this.state.requirevalue9day == '08' ? 'selected' : ''}>  08  </option>
                            <option value ="09" selected={this.state.requirevalue9day == '09' ? 'selected' : ''}>  09  </option>          {
                              this.state.day.map(
                                data =>
                                <option value={data} selected={this.state.requirevalue9day == data ? 'selected' : ''}>{data}</option>
                              )
                              }
                            </select>

                            </div>&nbsp;
                            <div style={{display: 'inline-block'}}>

                            <select  onChange={(e) => this.setState({ requirevalue9month: e.target.value })}>
                            <option value ="">  เดือน  </option>
                            <option value ="01" selected={this.state.requirevalue9month == '01' ? 'selected' : ''}>  01  </option>
                            <option value ="02" selected={this.state.requirevalue9month == '02' ? 'selected' : ''}>  02  </option>
                            <option value ="03" selected={this.state.requirevalue9month == '03' ? 'selected' : ''}>  03  </option>
                            <option value ="04" selected={this.state.requirevalue9month == '04' ? 'selected' : ''}>  04  </option>
                            <option value ="05" selected={this.state.requirevalue9month == '05' ? 'selected' : ''}>  05  </option>
                            <option value ="06" selected={this.state.requirevalue9month == '06' ? 'selected' : ''}>  06  </option>
                            <option value ="07" selected={this.state.requirevalue9month == '07' ? 'selected' : ''}>  07  </option>
                            <option value ="08" selected={this.state.requirevalue9month == '08' ? 'selected' : ''}>  08  </option>
                            <option value ="09" selected={this.state.requirevalue9month == '09' ? 'selected' : ''}>  09  </option>
                            {
                              this.state.month.map(
                                data =>
                                <option value={data} selected={this.state.requirevalue9month == data ? 'selected' : ''}>{data}</option>
                              )
                              }
                            </select>
                            </div>&nbsp;
                            <div style={{display: 'inline-block'}}>

                            <select onChange={(e) => this.setState({ requirevalue9year: e.target.value })}  >
                            <option value ="">  ปี พ.ศ  </option>
                            {
                              this.state.year.map(
                                data =>
                                <option value={data} selected={this.state.requirevalue9year == data ? 'selected' : ''}>{data}</option>
                              )
                              }
                            </select>
                            </div>
                            </div></td>
                            </tr>

    }
    else
    {
      return '';
    }
  }

  Showrequire4()
  {
    if(this.state.requirevalue4 == "ไม่ทำ")
    {
      return '';

    }
    else if(this.state.requirevalue4 != "")
    {
      return <tr>
      <th >{this.state.requirevar8}</th>
      <td ><div style={{width: '190px'}}>
      <div style={{display: 'inline-block'}}>

      <select onChange={(e) => this.setState({ requirevalue8day: e.target.value })} name="dayex">
      <option value ="">  วัน  </option>
      <option value ="01" selected={this.state.requirevalue8day == '01' ? 'selected' : ''}>  01  </option>
      <option value ="02" selected={this.state.requirevalue8day == '02' ? 'selected' : ''}>  02  </option>
      <option value ="03" selected={this.state.requirevalue8day == '03' ? 'selected' : ''}>  03  </option>
      <option value ="04" selected={this.state.requirevalue8day == '04' ? 'selected' : ''}>  04  </option>
      <option value ="05" selected={this.state.requirevalue8day == '05' ? 'selected' : ''}>  05  </option>
      <option value ="06" selected={this.state.requirevalue8day == '06' ? 'selected' : ''}>  06  </option>
      <option value ="07" selected={this.state.requirevalue8day == '07' ? 'selected' : ''}>  07  </option>
      <option value ="08" selected={this.state.requirevalue8day == '08' ? 'selected' : ''}>  08  </option>
      <option value ="09" selected={this.state.requirevalue8day == '09' ? 'selected' : ''}>  09  </option>
      {
        this.state.day.map(
          data =>
          <option value={data} selected={this.state.requirevalue8day == data ? 'selected' : ''}>{data}</option>
        )
        }
      </select>

      </div>&nbsp;
      <div style={{display: 'inline-block'}}>

      <select  onChange={(e) => this.setState({ requirevalue8month: e.target.value })}>
      <option value ="">  เดือน  </option>
      <option value ="01" selected={this.state.requirevalue8month == '01' ? 'selected' : ''}>  01  </option>
      <option value ="02" selected={this.state.requirevalue8month == '02' ? 'selected' : ''}>  02  </option>
      <option value ="03" selected={this.state.requirevalue8month == '03' ? 'selected' : ''}>  03  </option>
      <option value ="04" selected={this.state.requirevalue8month == '04' ? 'selected' : ''}>  04  </option>
      <option value ="05" selected={this.state.requirevalue8month == '05' ? 'selected' : ''}>  05  </option>
      <option value ="06" selected={this.state.requirevalue8month == '06' ? 'selected' : ''}>  06  </option>
      <option value ="07" selected={this.state.requirevalue8month == '07' ? 'selected' : ''}>  07  </option>
      <option value ="08" selected={this.state.requirevalue8month == '08' ? 'selected' : ''}>  08  </option>
      <option value ="09" selected={this.state.requirevalue8month == '09' ? 'selected' : ''}>  09  </option>
      {
        this.state.month.map(
          data =>
          <option value={data} selected={this.state.requirevalue8month == data ? 'selected' : ''}>{data}</option>
        )
        }
      </select>
      </div>&nbsp;
      <div style={{display: 'inline-block'}}>

      <select onChange={(e) => this.setState({ requirevalue8year: e.target.value })}  >
      <option value ="">  ปี พ.ศ  </option>
      {
        this.state.year.map(
          data =>
          <option value={data} selected={this.state.requirevalue8year == data ? 'selected' : ''}>{data}</option>
        )
        }
      </select>
      </div>
      </div></td>
      </tr>
    }
    else
    {
      return '';
    }
  }
  Showrequire3()
  {
    if(this.state.requirevalue3 == "ทำ")
    {
      return   <tr>
      <th >{this.state.requirevar7}</th>
      <td ><div style={{width: '190px'}}>
      <div style={{display: 'inline-block'}}>

      <select onChange={(e) => this.setState({ requirevalue7day: e.target.value })} name="dayex">
      <option value ="">  วัน  </option>
      <option value ="01" selected={this.state.requirevalue7day == '01' ? 'selected' : ''}>  01  </option>
      <option value ="02" selected={this.state.requirevalue7day == '02' ? 'selected' : ''}>  02  </option>
      <option value ="03" selected={this.state.requirevalue7day == '03' ? 'selected' : ''}>  03  </option>
      <option value ="04" selected={this.state.requirevalue7day == '04' ? 'selected' : ''}>  04  </option>
      <option value ="05" selected={this.state.requirevalue7day == '05' ? 'selected' : ''}>  05  </option>
      <option value ="06" selected={this.state.requirevalue7day == '06' ? 'selected' : ''}>  06  </option>
      <option value ="07" selected={this.state.requirevalue7day == '07' ? 'selected' : ''}>  07  </option>
      <option value ="08" selected={this.state.requirevalue7day == '08' ? 'selected' : ''}>  08  </option>
      <option value ="09" selected={this.state.requirevalue7day == '09' ? 'selected' : ''}>  09  </option>
      {
        this.state.day.map(
          data =>
          <option value={data} selected={this.state.requirevalue7day == data ? 'selected' : ''}>{data}</option>
        )
        }
      </select>

      </div>&nbsp;
      <div style={{display: 'inline-block'}}>

      <select  onChange={(e) => this.setState({ requirevalue7month: e.target.value })}>
      <option value ="">  เดือน  </option>
      <option value ="01" selected={this.state.requirevalue7month == '01' ? 'selected' : ''}>  01  </option>
      <option value ="02" selected={this.state.requirevalue7month == '02' ? 'selected' : ''}>  02  </option>
      <option value ="03" selected={this.state.requirevalue7month == '03' ? 'selected' : ''}>  03  </option>
      <option value ="04" selected={this.state.requirevalue7month == '04' ? 'selected' : ''}>  04  </option>
      <option value ="05" selected={this.state.requirevalue7month == '05' ? 'selected' : ''}>  05  </option>
      <option value ="06" selected={this.state.requirevalue7month == '06' ? 'selected' : ''}>  06  </option>
      <option value ="07" selected={this.state.requirevalue7month == '07' ? 'selected' : ''}>  07  </option>
      <option value ="08" selected={this.state.requirevalue7month == '08' ? 'selected' : ''}>  08  </option>
      <option value ="09" selected={this.state.requirevalue7month == '09' ? 'selected' : ''}>  09  </option>
      {
        this.state.month.map(
          data =>
          <option value={data} selected={this.state.requirevalue7month == data ? 'selected' : ''}>{data}</option>
        )
        }
      </select>
      </div>&nbsp;
      <div style={{display: 'inline-block'}}>

      <select onChange={(e) => this.setState({ requirevalue7year: e.target.value })}  >
      <option value ="">  ปี พ.ศ  </option>
      {
        this.state.year.map(
          data =>
          <option value={data} selected={this.state.requirevalue7year == data ? 'selected' : ''}>{data}</option>
        )
        }
      </select>
      </div>
      </div></td>
      </tr>

    }
    else
    {
      return '';
    }
  }
  Changeclass()
  {

    this.setState({
      flagrecheck:1,
      hidediv:'',
      showdiv:'columnhide',
    })

  }
  Changedefault()
  {

    this.setState({
      flagrecheck:0,
      hidediv:'columnhide',
      showdiv:'',
    })

  }
  Checkflag(){
    if(this.state.flagrecheck == 0)
    {
      return <div><a onClick={this.Changeclass} href="#step3" class="btn btn-success btn-margin" >บันทึก</a><a href="#step2" class="btn btn-default btn-margin" data-toggle="tab" aria-controls="step2" role="tab">กลับไป Step 2</a></div>;
    }
    else
    {
      return <div><button  class="btn btn-success btn-margin" type="submit">บันทึกรายการ</button><button  onClick={this.Changedefault} class="btn btn-warning btn-margin" type="button">แก้ไขรายการ</button></div>


    }
  }
  Showrecheck(){
    if(this.state.flagrecheck == 0)
    {
      return<a  class="btn btn-success btn-margin" >บันทึก</a>;
    }
    else
    {

    }
  }
validatemember(){
  let emailError ='';
  let citizenidError ='';
  let email = this.state.email;
  let citizenid = this.state.citizenid;
  const isInteger = /^[0-9]+$/;
  if(this.state.citizenid.length < 13 || this.state.citizenid === ''){
    citizenidError ="เลขบัตรประชาชนไม่ถูกต้อง";
  }
  if(!isInteger.test(this.state.citizenid) ){
    citizenidError ="เลขบัตรประชาชนไม่ถูกต้อง";
  }
  if(!this.state.email.includes('@')){
    emailError ="อีเมลไม่ถูกต้อง";
  }

    this.state.member.map(function(member){
      if(email.includes(member.email)){
        emailError ="อีเมลนี้ถูกใช้ไปแล้ว";
      }
      if(citizenid.includes(member.id_num)){
        citizenidError ="เลขบัตรประชาชนนี้ถูกใช้ไปแล้ว";
      }
    });


  if(emailError || citizenidError){
    this.setState({
      emailError,citizenidError
    });
    return false;
  }
  return true;
}
handleChangeCasetype(e){
  this.setState({
    casetypeid:e.target.value,
  })
  if(e.target.value != '')
  {

  let result = this.state.casetype.find((casetype) => {
    return casetype.id = e.target.value
  })
  let userfil = this.state.user.find((user) => {
    return user.id == result.default_user_block_id
  })
  let partnerfil = this.state.partner.find((partner) => {
    return partner.id == result.default_partner_block_id
  })
  let coorfil = this.state.coordinator.filter((coordinator) => {
    return coordinator.block_id == result.default_coor_block_id
  })

    console.log(userfil)
    this.setState({
      //user :userfil,
      coordinate:coorfil,
      username:userfil.name,
      partnername:partnerfil.name,
      coorname:coorfil.user_name,
      partnerid:result.default_partner_block_id,
      userid:result.default_user_block_id,
      requirevar1:result.requirename_var1,
      requirevar2:result.requirename_var2,
      requirevar3:result.requirename_var3,
      requirevar4:result.requirename_var4,
      requirevar5:result.requirename_var5,
      requirevar6:result.requirename_var6,
      requirevar7:result.requirename_var7,
      requirevar8:result.requirename_var8,
      requirevar9:result.requirename_var9,
      requirevar10:result.requirename_var10,
      requirevar11:result.requirename_var11,
      requirevar12:result.requirename_var12,
      requirevar13:result.requirename_var13,
      requirevar14:result.requirename_var14,
      requirevar15:result.requirename_var15,
      requirevar16:result.requirename_var16,
      requirevar17:result.requirename_var17,
      requirevar18:result.requirename_var18,
      requirevar19:result.requirename_var19,
      requirevar20:result.requirename_var20,
    })
}
else{
    this.state.partnerid = 0;
    this.state.partnername = "โปรดเลือก";
    this.state.userid = 0;
    this.state.username = "โปรดเลือก";
    this.state.requirevar1 = "โปรดเลือกชนิดของรายงาน";
    this.state.requirevar2="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar3="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar4="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar5="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar6="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar7="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar8="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar9="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar10="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar11="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar12="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar13="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar14="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar15="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar16="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar17="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar18="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar19="โปรดเลือกชนิดของรายงาน";
    this.state.requirevar20="โปรดเลือกชนิดของรายงาน";
}
  console.log(e.target.value);

}

  Showuser(){
  if(this.state.userid != '' && this.state.coordinateid != '' && this.state.casechannelid != ''&& this.state.partnerid != '')
  {
    let usershow = this.state.user.find((user) => {
      return user.id = this.state.userid
    })
    let coordinateshow = this.state.coordinate.find((coordinate) => {
      return coordinate.id = this.state.coordinateid
    })
    let casechannelshow = this.state.casechannel.find((casechannel) => {
      return casechannel.id = this.state.casechannelid
    })
    let partnershow = this.state.partner.find((partner) => {
      return partner.id = this.state.partnerid
    })
      return   /*<table style={{width: '100%'}}>
                            <tr>
                            <th >ผู้แจ้งงาน	</th>
                            <td ><div style={{width: '190px'}}>
                              {usershow.name}

                            </div></td>
                            </tr>
                            <tr><th></th><td>&nbsp;</td></tr>
                            <tr>
                            <th >ผู้ประสานงาน	</th>
                            <td ><div style={{width: '190px'}}>
                              {coordinateshow.user_name}
                            </div></td>
                            </tr>
                            <tr><th></th><td>&nbsp;</td></tr>
                            <tr>
                            <th >เส้นทางรับงาน</th>
                            <td ><div style={{width: '190px'}}>
                              {casechannelshow.name}
                            </div></td>
                            </tr>
                            <tr><th></th><td>&nbsp;</td></tr>
                            <tr>
                            <th >ผู้ให้คำปรึกษา	</th>
                            <td ><div style={{width: '190px'}}>
                              {partnershow.name}
                            </div></td>
                            </tr>
                            </table>*/
    }
    else {
    return <p></p>
}
}
  Showcoor(){
if(this.state.coordinateid != '' )
{

  let coordinateshow = this.state.coordinate.find((coordinate) => {
    return coordinate.user_id = this.state.coordinateid
  })
  console.log(coordinateshow);
    return   <table style={{width: '100%'}}>
                          <tr>
                          <th >ชื่อ - นามสกุล	</th>
                          <td ><div style={{width: '190px'}}>
                            {this.state.coorname}

                          </div></td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>

                          </tr>

                          </table>
  }
  else {
  return <p></p>
}
}

Showcase(){
if(this.state.casecategoryid != '' && this.state.casetypeid != '' && this.state.casesubtypeid != '' )
{

let casecategoryshow = this.state.casecategory.find((casecategory) => {
  return casecategory.id = this.state.casecategoryid
})
let casetypeshow = this.state.casetype.find((casetype) => {
  return casetype.id = this.state.casetypeid
})
let casesubtypeshow = this.state.casesubtype.find((casesubtype) => {
  return casesubtype.id = this.state.casesubtypeid
})
  return   <table style={{width: '100%'}}>
                        <tr>
                        <th >ประเภทของใบงาน	</th>
                        <td ><div style={{width: '190px'}}>
                          {casecategoryshow.name}

                        </div></td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >ชนิดของใบงาน	</th>
                        <td >
                          {casetypeshow.name}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >ชนิดย่อย ของใบงาน
	                       </th>
                        <td >
                            {casesubtypeshow.name}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >ชื่อใบงาน
                        </th>
                        <td >
                          {this.state.casename}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar1}
                        </th>
                        <td >
                        {this.state.requirevalue1}
                        </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar2}
                        </th>
                        <td >
                          {this.state.requirevalue2}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar3}
                        </th>
                        <td >
                        {this.state.requirevalue3}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar4}
                        </th>
                        <td >
                          {this.state.requirevalue4}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar5}
                        </th>
                        <td >
                          {this.state.requirevalue5}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar6}
                        </th>
                        <td >
                          {this.state.requirevalue6}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar7}
                        </th>
                        <td >
                          {this.state.requirevalue7}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar8}
                        </th>
                        <td >
                          {this.state.requirevalue8}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar9}
                        </th>
                        <td >
                          {this.state.requirevalue9}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar10}
                        </th>
                        <td >
                          {this.state.requirevalue10}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar11}
                        </th>
                        <td >
                          {this.state.requirevalue11}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar12}
                        </th>
                        <td >
                          {this.state.requirevalue12}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar13}
                        </th>
                        <td >
                          {this.state.requirevalue13}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar14}
                        </th>
                        <td >
                          {this.state.requirevalue14}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar15}
                        </th>
                        <td >
                          {this.state.requirevalue15}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar16}
                        </th>
                        <td >
                          {this.state.requirevalue16}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar17}
                        </th>
                        <td >
                          {this.state.requirevalue17}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar18}
                        </th>
                        <td >
                          {this.state.requirevalue18}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar19}
                        </th>
                        <td >
                          {this.state.requirevalue19}
                      </td>
                        </tr>
                        <tr><th></th><td>&nbsp;</td></tr>
                        <tr>
                        <th >{this.state.requirevar20}
                        </th>
                        <td >
                          {this.state.requirevalue20}
                      </td>
                        </tr>
                        </table>
}
else {
return <p></p>
}
}

handleLoadassetfile(e){
  e.preventDefault();

  this.setState({
    reloadassetfileflag:1

  })
  let assetid ='';

  this.state.assetdetail.map(function(assetdetail){
       assetid = assetdetail.id;
  });
  axios.post('/wealththaiinsurance/choose/memberassetfile',{
    assetid:assetid,
    }).then(res=>{

    console.log(res.data);
    this.setState({
      assetfile:res.data,
      reloadassetfileflag:0,
    })
  });
}

Reloadassetfileflag(){
  if(this.state.reloadassetfileflag ===0) {
    return <a style={{float:'right',fontsize:'18px'}}  onClick={this.handleLoadassetfile}><i class="fa fa-refresh"></i></a>
  }
  else{
    return <a style={{float:'right',fontsize:'18px'}}  onClick={this.handleLoadassetfile}><i class="fa fa-refresh fa-spin"></i></a>

  }

}

handleLoadmemberfile(e){
  e.preventDefault();

  this.setState({
    reloadmemfileflag:1

  })
  let memberid ='';
  this.state.memberprofile.map(function(memberprofile){
       memberid = memberprofile.id;
  });
  axios.post('/wealththaiinsurance/add/memberfile',{
    memberid:memberid,
  }).then(res=>{

    console.log(res.data);
    this.setState({
      memberfile:res.data,
      reloadmemfileflag:0

    })
  });
}

Reloadmemberfileflag(){
  if(this.state.reloadmemfileflag ===0) {
    return <a style={{float:'right',fontsize:'18px'}}  onClick={this.handleLoadmemberfile}><i class="fa fa-refresh"></i></a>
  }
  else{
    return <a style={{float:'right',fontsize:'18px'}}  onClick={this.handleLoadmemberfile}><i class="fa fa-refresh fa-spin"></i></a>

  }

}
handleSubmitcase(e){
  let memberid ='';
  let refasset ='';
  let pushpublic = [];
  let pushpartnername2 = [];
  let pushguildmembername = [];
  let pushgroupmembername = [];
  let pushgrouppidname = [];
  let pushgrouppartnername = [];
  let pushusername2 = [];
  let pushassurance = [];

 e.preventDefault();

 this.state.memberprofile.map(function(memberprofile){
      memberid = memberprofile.id;
 });
 this.state.assetdetail.map(function(assetdetail){
      refasset = assetdetail.id;
 });
 this.state.publicname.map(function(publicname){
      pushpublic.push(publicname.id)
 });
 this.state.partnername2.map(function(partnername2){
      pushpartnername2.push(partnername2.id)
 });
 this.state.username2.map(function(username2){
      pushusername2.push(username2.id)
 });
 this.state.guildmembername.map(function(guildmembername){
      pushguildmembername.push(guildmembername.id)
 });
 this.state.groupmembername.map(function(groupmembername){
      pushgroupmembername.push(groupmembername.id)
 });
 this.state.grouppidname.map(function(grouppidname){
      pushgrouppidname.push(grouppidname.id)
 });
 this.state.grouppartnername.map(function(grouppartnername){
      pushgrouppartnername.push(grouppartnername.id)
 });
 console.log("Assu"+this.state.assurancename.length);
 if(this.state.assurancename.length >1)
 {
   this.state.assurancename.map(function(assurancename){
        pushassurance.push(assurancename.name)
   });
 }
 else
{
  pushassurance.push(this.state.assurancenameedit)
}

       axios.post('/wealththaiinsurance/submitedit/case/'+this.state.caseid,{
       publicname:pushpublic,
       partnername2:pushpartnername2,
       username2:pushusername2,
       guildmembername:pushguildmembername,
       groupmembername:pushgroupmembername,
       grouppidname:pushgrouppidname,
       grouppartnername:pushgrouppartnername,
       nationality:this.state.nationality,
       more:this.state.more,
       couple_email:this.state.couple_email,
       belongtopidmember:this.state.belongtopidmember,
       userid:this.state.userid,
       coordinate:this.state.coordinateid,
       partnerid:this.state.partnerid,
       casechannelid:this.state.casechannelid,
       casecategoryid:this.state.casecategoryid,
       casetypeid:this.state.casetypeid,
       casesubtypeid:this.state.casesubtypeid,
       casename:this.state.casename,
       membercaseowner:memberid,
       refasset:refasset,
       refname:this.state.refname,
       requirevalue1:this.state.requirevalue1,
       requirevalue2:this.state.requirevalue2,
       requirevalue3:this.state.requirevalue3,
       requirevalue4:this.state.requirevalue4,
       requirevalue5:this.state.requirevalue5,
       requirevalue6:this.state.requirevalue6,
       requirevalue7day:this.state.requirevalue7day,
       requirevalue7month:this.state.requirevalue7month,
       requirevalue7year:this.state.requirevalue7year,
       requirevalue8day:this.state.requirevalue8day,
       requirevalue8month:this.state.requirevalue8month,
       requirevalue8year:this.state.requirevalue8year,
       requirevalue9day:this.state.requirevalue9day,
       requirevalue9month:this.state.requirevalue9month,
       requirevalue9year:this.state.requirevalue9year,
       requirevalue10:pushassurance,
       requirevalue11:this.state.requirevalue11,
       requirevalue12:this.state.requirevalue12,
       requirevalue13:this.state.requirevalue13,
       requirevalue14:this.state.requirevalue14,
       requirevalue15:this.state.requirevalue15,
       requirevalue16:this.state.requirevalue16,
       requirevalue17:this.state.requirevalue17,
       requirevalue18:this.state.requirevalue18,
       requirevalue19:this.state.requirevalue19,
       requirevalue20:this.state.requirevalue20,
       //forcaseauthentication
       publicname:this.state.publicname,
       partnername2:this.state.partnername2,
       username2:this.state.username2,
       guildmembername:this.state.guildmembername,
       groupmembername:this.state.groupmembername,
       groupidname:this.state.groupidname,
       grouppartnername:this.state.grouppartnername,

     }).then(res=>{
       console.log(res.data);
       /*this.setState({
        membercar:res.data
      })*/
    });

    this.setState({
      notsuccessdiv:'columnhide',
      successdiv:'',
    })


}

handleSubmitNewAsset(e){
  let memberid ='';

 e.preventDefault();

 this.state.memberprofile.map(function(memberprofile){
      memberid = memberprofile.id;
 });

       axios.post('/wealththaiinsurance/store/asset',{
       userid:this.state.userid,
       memberid:memberid,
       nationality:this.state.nationality,
       more:this.state.more,
       couple_email:this.state.couple_email,
       belongtopidmember:this.state.belongtopidmember,
       issuerid:this.state.issuerid,
       assetname:this.state.assetname,
       refname:this.state.refname,
       ref_number1:this.state.ref_number1,
       ref_number2:this.state.ref_number2,
       ref_number3:this.state.ref_number3,
       ref_info1:this.state.ref_info1,
       ref_info2:this.state.ref_info2,
       ref_info3:this.state.ref_info3,
       ref_info4:this.state.ref_info4,
       ref_info5:this.state.ref_info5,
       ref_info6:this.state.ref_info6,
       ref_info7:this.state.ref_info7,
       ref_info8:this.state.ref_info8,
       ref_info9:this.state.ref_info9,
       ref_info10:this.state.ref_info10,
       ref_info11:this.state.ref_info11,
       ref_info12:this.state.ref_info12,
       ref_info13:this.state.ref_info13,
       ref_info14:this.state.ref_info14,
       ref_info15:this.state.ref_info15,
       ref_info16:this.state.ref_info16,
       ref_info17:this.state.ref_info17,
       ref_info18:this.state.ref_info18,
       amount:this.state.amount,
       assetvalue:this.state.assetvalue,
       cost:this.state.cost,
       validfromday:this.state.validfromday,
       validfrommonth:this.state.validfrommonth,
       validfromyear:this.state.validfromyear,
       validtoday:this.state.validtoday,
       validtomonth:this.state.validtomonth,
       validtoyear:this.state.validtoyear,
       contact_pid:this.state.contact_pid,
       note:this.state.note,
     }).then(res=>{
       console.log(res.data);
       this.setState({
        membercar:res.data,
        addassetflag:0
      })
    });

}

   handleSubmitMember(e){
    e.preventDefault();
    const isValid = this.validatemember();
    console.log(isValid);
    if(isValid === false){
      console.log(this.state.email);

    }
    else{
          axios.post('/wealththaiinsurance/store/member',{
          name:this.state.name,
          lname:this.state.lname,
          email:this.state.email,
          mobile:this.state.mobile,
          nickname:this.state.nickname,
          country_code:this.state.country_code,
          membertypeid:this.state.membertypeid,
          gender:this.state.gender,
          dayex:this.state.dayex,
          monthex:this.state.monthex,
          yearex:this.state.yearex,
          daybi:this.state.daybi,
          monthbi:this.state.monthbi,
          yearbi:this.state.yearbi,
          citizenid:this.state.citizenid,
          add1:this.state.add1,
          add1alley:this.state.add1alley,
          add1road:this.state.add1road,
          add1subdistrict:this.state.add1subdistrict,
          add1district:this.state.add1district,
          add1city:this.state.add1city,
          add1country:this.state.add1country,
          add1postcode:this.state.add1postcode,
          add1tel:this.state.add1tel,
          add1fax:this.state.add1fax,
          add2:this.state.add2,
          add2alley:this.state.add2alley,
          add2road:this.state.add2road,
          add2subdistrict:this.state.add2subdistrict,
          add2district:this.state.add2district,
          add2city:this.state.add2city,
          add2country:this.state.add2country,
          add2postcode:this.state.add2postcode,
          add2tel:this.state.add2tel,
          add2fax:this.state.add2fax,
          noadressflag:this.state.noadressflag,

        }).then(res=>{

          this.setState({
            member:res.data,
            addmemberflag:0
          })
        });

      }


  }

  handleChangeRequirevalue1(e){
    console.log(e.target.value);
    this.setState({
      requirevalue1:e.target.value,
    })
  }
  handleChangeRequirevalue2(e){
    console.log(e.target.value);
    this.setState({
      requirevalue2:e.target.value,
    })
  }
  handleChangeRequirevalue3(e){
    console.log(e.target.value);
    this.setState({
      requirevalue3:e.target.value,
    })
  }
  handleChangeRequirevalue4(e){
    console.log(e.target.value);
    this.setState({
      requirevalue4:e.target.value,
    })
  }
  handleChangeRequirevalue5(e){
    console.log(e.target.value);
    this.setState({
      requirevalue5:e.target.value,
    })
  }
  handleChangeRequirevalue6(e){
    console.log(e.target.value);
    this.setState({
      requirevalue6:e.target.value,
    })
  }
  handleChangeRequirevalue7(e){
    console.log(e.target.value);
    this.setState({
      requirevalue7:e.target.value,
    })
  }
  handleChangeRequirevalue8(e){
    console.log(e.target.value);
    this.setState({
      requirevalue8:e.target.value,
    })
  }
  handleChangeRequirevalue9(e){
    console.log(e.target.value);
    this.setState({
      requirevalue9:e.target.value,
    })
  }
  handleChangeRequirevalue10(e){
    console.count('onChange')
        console.log("Val", e);
        this.setState({ assurancename: e });
  }

  handleChangeRequirevalue11(e){
    console.log(e.target.value);
    this.setState({
      requirevalue11:e.target.value,
    })
  }
  handleChangeRequirevalue12(e){
    console.log(e.target.value);
    this.setState({
      requirevalue12:e.target.value,
    })
  }
  handleChangeRequirevalue13(e){
    console.log(e.target.value);
    this.setState({
      requirevalue13:e.target.value,
    })
  }
  handleChangeRequirevalue14(e){
    console.log(e.target.value);
    this.setState({
      requirevalue14:e.target.value,
    })
  }
  handleChangeRequirevalue15(e){
    console.log(e.target.value);
    this.setState({
      requirevalue15:e.target.value,
    })
  }
  handleChangeRequirevalue16(e){
    console.log(e.target.value);
    this.setState({
      requirevalue16:e.target.value,
    })
  }
  handleChangeRequirevalue17(e){
    console.log(e.target.value);
    this.setState({
      requirevalue17:e.target.value,
    })
  }
  handleChangeRequirevalue18(e){
    console.log(e.target.value);
    this.setState({
      requirevalue18:e.target.value,
    })
  }
  handleChangeRequirevalue19(e){
    console.log(e.target.value);
    this.setState({
      requirevalue19:e.target.value,
    })
  }
  handleChangeRequirevalue20(e){
    console.log(e.target.value);
    this.setState({
      requirevalue20:e.target.value,
    })
  }
  handleChangeCasename(e){
    console.log(e.target.value);
    this.setState({
      casename:e.target.value,
    })
  }
  handleChangeNote(e){
    console.log(e.target.value);
    this.setState({
      note:e.target.value,
    })
  }
  handleChangeCost(e){
    console.log(e.target.value);
    this.setState({
      cost:e.target.value,
    })
  }
  handleChangeAssetvalue(e){
    console.log(e.target.value);
    this.setState({
      assetvalue:e.target.value,
    })
  }
  handleChangeAmount(e){
    console.log(e.target.value);
    this.setState({
      amount:e.target.value,
    })
  }
  handleChangeRefinfo1(e){
    console.log(e.target.value);
    this.setState({
      ref_info1:e.target.value,
    })
  }
  handleChangeRefinfo2(e){
    console.log(e.target.value);
    this.setState({
      ref_info2:e.target.value,
    })
  }
  handleChangeRefinfo3(e){
    console.log(e.target.value);
    this.setState({
      ref_info3:e.target.value,
    })
  }
  handleChangeRefinfo4(e){
    console.log(e.target.value);
    this.setState({
      ref_info4:e.target.value,
    })
  }
  handleChangeRefinfo5(e){
    console.log(e.target.value);
    this.setState({
      ref_info5:e.target.value,
    })
  }
  handleChangeRefinfo6(e){
    console.log(e.target.value);
    this.setState({
      ref_info6:e.target.value,
    })
  }
  handleChangeRefinfo7(e){
    console.log(e.target.value);
    this.setState({
      ref_info7:e.target.value,
    })
  }
  handleChangeRefinfo8(e){
    console.log(e.target.value);
    this.setState({
      ref_info8:e.target.value,
    })
  }
  handleChangeRefinfo9(e){
    console.log(e.target.value);
    this.setState({
      ref_info9:e.target.value,
    })
  }
  handleChangeRefinfo10(e){
    console.log(e.target.value);
    this.setState({
      ref_info10:e.target.value,
    })
  }
  handleChangeRefinfo11(e){
    console.log(e.target.value);
    this.setState({
      ref_info11:e.target.value,
    })
  }
  handleChangeRefinfo12(e){
    console.log(e.target.value);
    this.setState({
      ref_info12:e.target.value,
    })
  }
  handleChangeRefinfo13(e){
    console.log(e.target.value);
    this.setState({
      ref_info13:e.target.value,
    })
  }
  handleChangeRefinfo14(e){
    console.log(e.target.value);
    this.setState({
      ref_info14:e.target.value,
    })
  }
  handleChangeRefinfo15(e){
    console.log(e.target.value);
    this.setState({
      ref_info15:e.target.value,
    })
  }
  handleChangeRefinfo16(e){
    console.log(e.target.value);
    this.setState({
      ref_info16:e.target.value,
    })
  }
  handleChangeRefinfo17(e){
    console.log(e.target.value);
    this.setState({
      ref_info17:e.target.value,
    })
  }
  handleChangeRefinfo18(e){
    console.log(e.target.value);
    this.setState({
      ref_info18:e.target.value,
    })
  }
  handleChangeRefnumber1(e){
    console.log(e.target.value);
    this.setState({
      ref_number1:e.target.value,
    })
  }
  handleChangeRefnumber2(e){
    console.log(e.target.value);
    this.setState({
      ref_number2:e.target.value,
    })
  }
  handleChangeRefnumber3(e){
    console.log(e.target.value);
    this.setState({
      ref_number3:e.target.value,
    })
  }
  handleChangeRefname(e){
    console.log(e.target.value);
    this.setState({
      refname:e.target.value,
    })
  }
  handleChangeAssetname(e){
    console.log(e.target.value);
    this.setState({
      assetname:e.target.value,
    })
  }
  handleChangeAdd2(e){
    this.setState({
      add2:e.target.value,
    })
  }
  handleChangeAdd2alley(e){
    this.setState({
      add2alley:e.target.value,
    })
  }
  handleChangeAdd2road(e){
    this.setState({
      add2road:e.target.value,
    })
  }
  handleChangeAdd2subdistrict (add2subdistrict){
    this.setState(
      { add2subdistrict },
      () => console.log(`Option selected:`, this.state.add2subdistrict)
    );
  };
  handleChangeAdd2district (add2district){
    this.setState(
      { add2district },
      () => console.log(`Option selected:`, this.state.add2district)
    );
  };
  handleChangeAdd2city (add2city){
    this.setState(
      { add2city },
      () => console.log(`Option selected:`, this.state.add2city)
    );
  };
  handleChangeAdd2country (add2country){
    this.setState(
      { add2country },
      () => console.log(`Option selected:`, this.state.add2country)
    );
  };
  handleChangeAdd2postcode(e){
    console.log(e.target.value);
    this.setState({
      add2postcode:e.target.value,
    })
  }
  handleChangeAdd2tel(e){
    console.log(e.target.value);
    this.setState({
      add2tel:e.target.value,
    })
  }
  handleChangeAdd2fax(e){
    console.log(e.target.value);
    this.setState({
      add2fax:e.target.value,
    })
  }

  handleChangeAdd1(e){
    console.log(e.target.value);
    this.setState({
      add1:e.target.value,
    })
  }
  handleChangeAdd1alley(e){
    console.log(e.target.value);
    this.setState({
      add1alley:e.target.value,
    })
  }
  handleChangeAdd1road(e){
    console.log(e.target.value);
    this.setState({
      add1road:e.target.value,
    })
  }
  handleChangeAdd1subdistrict (add1subdistrict){
    this.setState(
      { add1subdistrict },
      () => console.log(`Option selected:`, this.state.add1subdistrict)
    );
  };
  handleChangeAdd1district (add1district){
    this.setState(
      { add1district },
      () => console.log(`Option selected:`, this.state.add1district)
    );
  };
  handleChangeAdd1city (add1city){
    this.setState(
      { add1city },
      () => console.log(`Option selected:`, this.state.add1city)
    );
  };
  handleChangeAdd1country (add1country){
    this.setState(
      { add1country },
      () => console.log(`Option selected:`, this.state.add1country)
    );
  };
  handleChangeAdd1postcode(e){
    console.log(e.target.value);
    this.setState({
      add1postcode:e.target.value,
    })
  }
  handleChangeAdd1tel(e){
    console.log(e.target.value);
    this.setState({
      add1tel:e.target.value,
    })
  }
  handleChangeAdd1fax(e){
    console.log(e.target.value);
    this.setState({
      add1fax:e.target.value,
    })
  }
  dayrxpi(){
        return <option>{this.state.day}</option>
  }
  handleChangeDayEx (dayex){
    console.log(e.target.value);
    this.setState({
      dayex:e.target.value,
    })
  };
  handleChangeCitizenid(e){
    console.log(e.target.value);
    this.setState({
      citizenid:e.target.value,
    })
  }
  handleChangeName(e){
    console.log(e.target.value);
    this.setState({
      name:e.target.value,
    })
  }
  handleChangeNname(e){
    console.log(e.target.value);
    this.setState({
      nickname:e.target.value,
    })
  }
  handleChangeEmail(e){
    console.log(e.target.value);
    this.setState({
      email:e.target.value,
    })
  }
  handleChangeMobile(e){
    console.log(e.target.value);
    this.setState({
      mobile:e.target.value,
    })
  }
  handleChangeLname(e){
    console.log(e.target.value);
    this.setState({
      lname:e.target.value,
    })
  }
  Noadress(){
    this.setState({
      noadressflag:1

    })
    console.log(this.state.noadressflag);

  }
  handleshowaddress(){
    this.setState({
      noadressflag:0

    })
    console.log(this.state.noadressflag);

  }
  openaddmember(){
    this.setState({
      addmemberflag:1

    })
    console.log(this.state.addmemberflag);

  }
  closeaddmember(){
    this.setState({
      addmemberflag:0

    })
    console.log(this.state.addmemberflag);

  }
  openaddasset(){
    this.setState({
      addassetflag:1

    })
    console.log(this.state.addassetflag);

  }
  closeaddasset(){
    this.setState({
      addassetflag:0

    })
    console.log(this.state.addassetflag);

  }

  handlecheckemail(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/check/email',{
      email:this.state.email
    }).then(res=>{

      console.log(res.data);
      this.setState({
        emailflag:res.data

      })
    });
  }
  handleSubmitflag(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/add/memberchangeflag',{
      assetid:this.state.assetid
    }).then(res=>{

      console.log(res.data);
      this.setState({
        assetdetail:res.data

      })
    });
    axios.post('/wealththaiinsurance/choose/memberassetfile',{
      assetid:this.state.assetid
    }).then(res=>{

      console.log(res.data);
      this.setState({
        assetfile:res.data

      })
    });
    //console.log(e.target.value);
    this.setState({
      assetid:e.target.value,
    })
  }

  handleChangeGender (gender){
    this.setState(
      { gender },
      () => console.log(`Option selected:`, this.state.gender)
    );
  };
  handleChange (memberid){
    this.setState(
      { memberid },
      () => console.log(`Option selected:`, this.state.memberid)
    );
  };
  handleChangeAsset (asset){
    this.setState(
      { asset },
      () => console.log(`Option selected:`, this.state.asset)
    );
  };
  handleChangeMembertype (membertypeid){
    this.setState(
      { membertypeid },
      () => console.log(`Option selected:`, this.state.membertypeid)
    );
  };
  handleChangeAssetdtail (e){


    console.log(`Option selected:`, e.target.value);
    axios.get('/wealththaiinsurance/choose/memberasset?fileterassetid'+e.target.value,{
    }).then(response=>{

      console.log('assetdetail'+response.data);
      this.setState({
        assetdetail:response.data
      })
    }).catch(errors=>{
      console.log(errors);
    });

    axios.get('/wealththaiinsurance/choose/memberassetfile?fileterassetid'+e.target.value,{
    }).then(response=>{

      console.log(response.data);
      this.setState({
        assetfile:response.data

      })
    }).catch(errors=>{
      console.log(errors);
    });
    //console.log(e.target.value);
    this.setState({
      assetid:e.target.value
    })

  };
  handleChangeMemberid(e){
    this.setState({memberid: e.target.value});
  }

  handleSubmit(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/add/member',{
      memberid:this.state.memberid
    }).then(res=>{

      console.log(res.data);
      this.setState({
        memberprofile:res.data

      })
    });
    axios.post('/wealththaiinsurance/add/memberfile',{
      memberid:this.state.memberid
    }).then(res=>{

      console.log(res.data);
      this.setState({
        memberfile:res.data

      })
    });
    axios.post('/wealththaiinsurance/add/membercar',{
      memberid:this.state.memberid
    }).then(res=>{

      console.log(res.data);
      this.setState({
        membercar:res.data

      })
    });
    //console.log(e.target.value);
    this.setState({
      memberid:e.target.value,
    })
  }

  handleSubmitAsset(e){
    e.preventDefault();
    axios.post('/wealththaiinsurance/choose/memberasset',{
      assetid:this.state.assetid
    }).then(res=>{

      console.log(res.data);
      this.setState({
        assetdetail:res.data

      })
    });
    axios.post('/wealththaiinsurance/choose/memberassetfile',{
      assetid:this.state.assetid
    }).then(res=>{

      console.log(res.data);
      this.setState({
        assetfile:res.data

      })
    });
    //console.log(e.target.value);
    this.setState({
      assetid:e.target.value,
    })
  }




  NorenderAddress(){
      if(this.state.noadressflag === 0) {
        let countr = this.state.country.map(function (country) {
          return { value: country.id, label: country.name};
        })
        let cit = this.state.city.map(function (city) {
            return { value: city.id, label: city.name_in_thai};
        })

        let subdis = this.state.subdistrict.map(function (subdistrict) {
          return { value: subdistrict.id, label: subdistrict.name_in_thai};
        })

        let distr = this.state.district.map(function (district) {
          return { value: district.id, label: district.name_in_thai};
        })
        let da = this.state.day.map(function (day) {
          return { value: day , label: day};
        })
        return <div class="column3">
        <div class="card">
        <div class="card-header">ที่อยู่จัดส่งเอกสาร <a  style={{float:'right'}} onClick={this.Noadress}>ที่เดียวกับบัตร </a></div>
        <div class="card-body">
        <table style={{width: '100%'}}>
        <tr>
        <th >บ้านเลขที่</th>
        <td ><div style={{width: '190px'}}>
        <input onChange={this.handleChangeAdd2}value={this.state.add2} class="form-control"

        />
        </div></td>
        </tr>

        <tr><th></th><td>&nbsp;</td></tr>
        <tr>
        <th >ซอย</th>
        <td ><div style={{width: '190px'}}>
        <input onChange={this.handleChangeAdd2alley}value={this.state.add2alley} class="form-control"

        />
        </div></td>
        </tr>
        <tr><th></th><td>&nbsp;</td></tr>
        <tr>
        <th >ถนน</th>
        <td ><div style={{width: '190px'}}>
        <input onChange={this.handleChangeAdd2road}value={this.state.add2road} class="form-control"

        />
        </div></td>
        </tr>
        <tr><th></th><td>&nbsp;</td></tr>
        <tr>
        <th >ประเทศ</th>
        <td ><div style={{width: '190px'}}>
        <select style={{width: '190px'}} onChange={(e) => this.setState({ add2country: e.target.value })} class="form-control selectwidthauto country2" name="dayex">
        <option value="">โปรดเลือก</option>
        {
          this.state.country.map(
            data =>
            <option value={data.id}>{data.name}</option>
          )
          }
        </select>
        </div></td>
        </tr>
        <tr><th></th><td>&nbsp;</td></tr>
        <tr>
        <th >จังหวัด</th>
        <td ><div style={{width: '190px'}}>
        <select style={{width: '190px'}} onChange={(e) => this.setState({ add2city: e.target.value })} class="form-control selectwidthauto pro2 prodis2" name="dayex">
        <option value="">โปรดเลือก</option>
        {
          this.state.city.map(
            data =>
            <option value={data.id}>{data.name_in_thai}</option>
          )
          }
        </select>
        </div></td>
        </tr>
        <tr><th></th><td>&nbsp;</td></tr>
        <tr>
        <th >เขต/อำเภอ</th>
        <td ><div style={{width: '190px'}}>
        <select style={{width: '190px'}} onChange={(e) => this.setState({ add2district: e.target.value })} class="form-control selectwidthauto dis2 dissub2" name="dayex">
        <option value="">โปรดเลือก</option>
        {
          this.state.district.map(
            data =>
            <option value={data.id}>{data.name_in_thai}</option>
          )
          }
        </select>
        </div></td>
        </tr>
        <tr><th></th><td>&nbsp;</td></tr>
        <tr>
        <th >แขวงตำบล</th>
        <td ><div style={{width: '190px'}}>
        <select style={{width: '190px'}} onChange={(e) => this.setState({ add2subdistrict: e.target.value })} class="form-control selectwidthauto subdis2" name="dayex">
        <option value="">โปรดเลือก</option>
        {
          this.state.subdistrict.map(
            data =>
            <option value={data.id}>{data.name_in_thai}</option>
          )
          }
        </select>
        </div></td>
        </tr>
        <tr><th></th><td>&nbsp;</td></tr>
        <tr>
        <th >รหัสไปรษณีย์</th>
        <td ><div style={{width: '190px'}}>
        <input onChange={this.handleChangeAdd2postcode}value={this.state.add2postcode} class="form-control"

        />
        </div></td>
        </tr>
        <tr><th></th><td>&nbsp;</td></tr>
        <tr>
        <th >โทร</th>
        <td ><div style={{width: '190px'}}>
        <input onChange={this.handleChangeAdd2tel}value={this.state.add2tel} class="form-control"

        />
        </div></td>
        </tr>
        <tr><th></th><td>&nbsp;</td></tr>
        <tr>
        <th >แฟกซ์</th>
        <td ><div style={{width: '190px'}}>
        <input onChange={this.handleChangeAdd2fax}value={this.state.add2fax} class="form-control"

        />
        </div></td>
        </tr>
          &nbsp;


        </table>
                  <br/>
        </div>
        </div>
        </div>
      }else{
          return <div class="column3">
          <div class="card">
          <div class="card-header">ที่อยู่จัดส่งเอกสาร <a  style={{float:'right'}} onClick={this.handleshowaddress}>เพิ่มที่อยู่ </a></div>
          <div class="card-body" style={{color:'red'}}>
          **ที่เดียวกับที่อยู่ตามบัตรประชาชน
          </div>
          </div>
          </div>
      }
  }

  renderComponentByState(){
      if(this.state.addmemberflag === 0) {

          return <form onSubmit={this.handleSubmit}>
          <table style={{width: '100%'}} >

          <tr><th></th><td>&nbsp;</td></tr>
          <tr>
          <th style={{width: '200px'}}>ผู้เอาประกัน <b style={{color:'red'}}>*</b></th>
          <td ><div style={{width: '190px'}}>
              {this.state.membername} &nbsp;&nbsp;{this.state.memberlname}
          </div></td>
          <td >
          <a style={{float:'left'}} onClick={this.openaddmember} >เปลี่ยนผู้เอาประกัน</a>
          </td>
          <td style={{width: '700px'}}>
          &nbsp;
          </td>
          </tr>
          <br/>
          <button class="btn btn-success grouppartadd " type="submit">ตกลง</button>&nbsp;&nbsp;
          <a href="#step1" class="btn btn-default " data-toggle="tab" aria-controls="step1" role="tab">กลับไป Step 1</a>
        </table>
          </form>
      }else{

        let options = this.state.member.map(function (member) {
          return { value: member.id, label: member.name +' '+ member.lname };
        })
            return <form onSubmit={this.handleSubmit}>
            <table style={{width: '100%'}} >

            <tr><th></th><td>&nbsp;</td></tr>
            <tr>
            <th style={{width: '200px'}}>ผู้เอาประกัน <b style={{color:'red'}}>*</b></th>
            <td ><div style={{width: '190px'}}>
                <Select
                selectedValue={{ label: "กชชภัค สำราญวงศ์ ", value: 28 }}

                name="form-field-name"
                value={this.state.memberid}
                options={options}
                onChange={this.handleChange}
                onClick={console.log("heyyy")}
                />
            </div></td>
            <td >
            <a style={{float:'left'}} onClick={this.closeaddmember} >ยกเลิก</a>
            </td>
            <td style={{width: '700px'}}>
            &nbsp;
            </td>
            </tr>
            <br/>
            <button class="btn btn-success grouppartadd " type="submit">ตกลง</button>&nbsp;&nbsp;
            <a href="#step1" class="btn btn-default " data-toggle="tab" aria-controls="step1" role="tab">กลับไป Step 1</a>
          </table>
            </form>


    }
  }

  renderComponentAddress(){
      if(this.state.addassetflag === 0) {


          return <form onSubmit={this.handleSubmitAsset}>
          <table style={{width: '100%'}}>
          <tr><th></th><td>&nbsp;</td></tr>
          <tr>
          <th style={{width: '200px'}}>เลือกรถยนต์ <b style={{color:'red'}}>*</b></th>
          <td ><div style={{width: '180px'}}>
          <select style={{width: '190px'}} onChange={this.handleChangeAssetdtail} class="form-control " >
          <option value="">โปรดเลือก</option>
          {
            this.state.membercar.map(
              data =>
              <option value={data.id} selected={data.id == this.state.assetid ? 'selected' : ''}>{data.name}</option>
            )
            }
            </select>
          </div></td>
          <td >
          <a style={{float:'left'}} onClick={this.openaddasset} >เพิ่มรถยนต์</a>
          </td>
          <td style={{width: '700px'}}>
          &nbsp;
          </td>
          </tr>
          <br/>
        </table>
          </form>
      }else{
          return <form onSubmit={this.handleSubmitNewAsset}>
          {
            this.state.assettype.map(
              data =>
              <div>
              <div class="column3">
              <div class="card">
              <div class="card-body">

              <table style={{width: '100%'}}>
              <tr>
              <th >ยี่ห้อรถยนต์ <b style={{color:'red'}}>*</b></th>
              <td ><div style={{width: '190px'}}>
              <select style={{width: '190px'}} onChange={(e) => this.setState({ issuerid: e.target.value })} class="form-control " >
              <option value="">โปรดเลือก</option>
              {
                this.state.issuer.map(
                  data =>
                  <option value={data.id}>{data.name}</option>
                )
                }
                </select>
              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>

              <tr>
              <th >ชื่อ <b style={{color:'red'}}>*</b></th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeAssetname}value={this.state.assetname} class="form-control"/>
              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_name_head}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefname}value={this.state.refname} class="form-control"

              />
              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_num_head1}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefnumber1}value={this.state.ref_number1} class="form-control"

              />
              </div> </td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_num_head2}</th>
              <td ><div style={{width: '190px',display: 'flex'}}>
                      <input onChange={this.handleChangeRefnumber2}value={this.state.ref_number2} class="form-control"/>

              </div><div style={{color:'red'}}>{this.state.emailError}</div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_num_head3}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefnumber3}value={this.state.ref_number3} class="form-control"  />


              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head1} <b style={{color:'red'}}>*</b></th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo1}value={this.state.ref_info1} class="form-control"  />

              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head2}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo2}value={this.state.ref_info2} class="form-control"/>


              </div></td>
              </tr>


              </table>
              &nbsp;

              </div>
              </div>
              </div>
              <div class="column3">
              <div class="card">
              <div class="card-body">
              <table style={{width: '100%'}}>
              <tr>
              <th >{data.ref_info_head3}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo3}value={this.state.ref_info3} class="form-control"/>
              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head4}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo4}value={this.state.ref_info4} class="form-control"/>

              </div></td>
              </tr>

              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head5}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo5}value={this.state.ref_info5} class="form-control"/>

              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head6}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo6}value={this.state.ref_info6} class="form-control"/>

              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head7}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo7}value={this.state.ref_info7} class="form-control"/>
              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head8}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo8}value={this.state.ref_info8} class="form-control"/>
              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head9}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo9}value={this.state.ref_info9} class="form-control"/>

              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head10}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo10}value={this.state.ref_info10} class="form-control"/>

              </div></td>
              </tr>

              &nbsp;

              </table>
              </div>
              </div>
              </div>
              <div class="column3">
              <div class="card">
              <div class="card-body">
              <table style={{width: '100%'}}>
              <tr>
              <th >{data.ref_info_head11}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo11}value={this.state.ref_info11} class="form-control"/>

              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head12}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo12}value={this.state.ref_info12} class="form-control"/>

              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head13}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo13}value={this.state.ref_info13} class="form-control"/>

              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head14}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo14}value={this.state.ref_info14} class="form-control"/>

              </div></td>
              </tr>

              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head15}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo15}value={this.state.ref_info15} class="form-control"/>

              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head16}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo16}value={this.state.ref_info16} class="form-control"/>

              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_head17}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo17}value={this.state.ref_info17} class="form-control"/>
              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >{data.ref_info_hea18}</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeRefinfo18}value={this.state.ref_info18} class="form-control"/>
              </div></td>
              </tr>

              &nbsp;

              </table>
              </div>
              </div>
              </div>
              <div class="column">
              <div class="card">
              <div class="card-body">
              <div class="column3">
              <table style={{width: '100%'}}>

              <tr>
              <th >Amount</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeAmount}value={this.state.amount} class="form-control"  />

              </div></td>
              </tr>

              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >Estimate Market Value</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeAssetvalue}value={this.state.assetvalue} class="form-control"  />

              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>


              &nbsp;

              </table>
              </div>

              <div class="column3">
              <table style={{width: '100%'}}>

              <tr>
              <th >Cost</th>
              <td ><div style={{width: '190px'}}>
              <input onChange={this.handleChangeCost}value={this.state.cost} class="form-control"

              />
              </div></td>
              </tr>

              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >Note</th>
              <td ><div style={{width: '190px'}}>
              <textarea onChange={this.handleChangeNote}value={this.state.note} class="form-control"></textarea>
              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>


              &nbsp;

              </table>
              </div>
              <div class="column3">
              <table style={{width: '100%'}}>

              <tr>
              <th >Valid From</th>
              <td ><div style={{width: '190px'}}>
              <div style={{display: 'inline-block'}}>

              <select onChange={(e) => this.setState({ daybi: e.target.value })} name="dayex">
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

              </div>&nbsp;
              <div style={{display: 'inline-block'}}>

              <select  onChange={(e) => this.setState({ monthbi: e.target.value })}>
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
              </div>&nbsp;
              <div style={{display: 'inline-block'}}>

              <select onChange={(e) => this.setState({ yearbi: e.target.value })}  >
              <option value ="">  ปี พ.ศ  </option>
              {
                this.state.year.map(
                  data =>
                  <option value={data}>{data}</option>
                )
                }
              </select>
              </div>
              </div></td>
              </tr>

              <tr><th></th><td>&nbsp;</td></tr>
              <tr>
              <th >Valid To</th>
              <td ><div style={{width: '190px'}}>
              <div style={{display: 'inline-block'}}>

              <select onChange={(e) => this.setState({ daybi: e.target.value })} name="dayex">
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

              </div>&nbsp;
              <div style={{display: 'inline-block'}}>

              <select  onChange={(e) => this.setState({ monthbi: e.target.value })}>
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
              </div>&nbsp;
              <div style={{display: 'inline-block'}}>

              <select onChange={(e) => this.setState({ yearbi: e.target.value })}  >
              <option value ="">  ปี พ.ศ  </option>
              {
                this.state.year.map(
                  data =>
                  <option value={data}>{data}</option>
                )
                }
              </select>
              </div>
              </div></td>
              </tr>
              <tr><th></th><td>&nbsp;</td></tr>


              &nbsp;

              </table>
              </div>
              </div>
              </div>
              </div>
              </div>

            )
            }



          <div class="column3" >
          <button  class="btn btn-success btn-margin" type="submit">ตกลง</button>

          <button  class="btn btn-danger btn-margin" onClick={this.closeaddasset}>ยกเลิก</button>
          </div>
          </form>
      }
  }
  showdetail()
  {
    return           <div>

              <br/>
              <div style={{textAlign:'center',height:'800px'}}class={this.state.successdiv}>
              <h4 style={{color:'green'}}><i style={{fontSize:'100px'}} class="fa fa-check-circle"></i></h4>
              <h4 style={{color:'green',fontSize:'50px'}}>บันทึกเรียบร้อย!</h4>
              <a class="btn btn-default btn-margin" href="/wealththaiinsurance">เพิ่มงานใหม่</a>
              <a class="btn btn-default btn-margin" href={"/wealththaiinsurance/cases/"+this.state.caseid+"/detail/show"}>กลับไปหน้ารายละเอียดงาน</a>
              </div>
              <div class={this.state.notsuccessdiv}>


              <div class="tab-content">
              <div class="tab-pane active" role="tabpanel" id="step1">
              <p style={{color:'red'}}>&nbsp;&nbsp;&nbsp;&nbsp;กรุณากรอกช่องที่มีเครื่องหมาย * ให้ครบ</p>
                            <div class="column">
                                <div class="card">
                                    <div class="card-header" style={{backgroundColor:'#D6FBFF'}}>Step 1 ผู้แจ้งงานและผู้ประสานงาน</div>
                                        <div class="card-body">
                                        <div class="column2">
                                        <table >
                                        <tr>

                                        <th style={{width: '200px'}}>ประเภทของใบงาน <b style={{color:'red'}}>*</b></th>
                                        <td ><div style={{width: '190px'}}>

                                        <select style={{width: '190px'}} onChange={(e) => this.setState({ casecategoryid: e.target.value })} class="form-control " >
                                        <option value="">โปรดเลือก</option>
                                        {
                                          this.state.casecategory.map(
                                            data =>
                                            <option value={data.id} selected={data.id == this.state.casecategoryid ? 'selected' : ''} >{data.name}</option>
                                          )
                                          }
                                          </select>
                                        </div></td>
                                        </tr>
                                        <tr><th></th><td>&nbsp;</td></tr>
                                        <tr>
                                        <th >ชนิดของใบงาน <b style={{color:'red'}}>*</b></th>
                                        <td ><div style={{width: '190px'}}>
                                        <select style={{width: '190px'}} onChange={this.handleChangeCasetype} class="form-control " >
                                        <option value="">โปรดเลือก</option>
                                        {
                                          this.state.casetype.map(
                                            data =>
                                            <option value={data.id} selected={data.id == this.state.casetypeid ? 'selected' : ''}>{data.name}</option>
                                          )
                                          }
                                          </select>
                                        </div></td>
                                        </tr>
                                        <tr><th></th><td>&nbsp;</td></tr>
                                        <tr>
                                        <th >ชนิดย่อย ของใบงาน <b style={{color:'red'}}>*</b></th>
                                        <td ><div style={{width: '190px'}}>
                                        <select style={{width: '190px'}}  onChange={(e) => this.setState({ casesubtypeid: e.target.value })} class="form-control " >
                                        <option value="">โปรดเลือก</option>
                                        {
                                          this.state.casesubtype.map(
                                            data =>
                                            <option value={data.id} selected={data.id == this.state.casesubtypeid ? 'selected' : ''}>{data.name}</option>
                                          )
                                          }
                                          </select>
                                        </div></td>
                                        </tr>
                                        <tr><th></th><td>&nbsp;</td></tr>
                                        <tr>
                                        <th >ชื่อใบงาน <b style={{color:'red'}}>*</b></th>
                                        <td ><div style={{width: '190px'}}>
                                        <input onChange={this.handleChangeCasename}value={this.state.casename} class="form-control"/>
                                        </div></td>
                                        </tr>


                                        </table>
                                        </div>
                                        <div class="column2">
                                        <table >

                                        <tr>
                                        <th style={{width: '200px'}}>ผู้แจ้งงาน <b style={{color:'red'}}>*</b></th>
                                        <td ><div >

                                          <select style={{width: '190px'}} class="selectwidthauto form-control" onChange={(e) => this.setState({ userid: e.target.value })}>
                                            {
                                              this.state.user.map(
                                                data =>
                                                <option value={data.id} selected={data.id == this.state.userid ? 'selected' : ''}>
                                                {data.name}
                                              </option>
                                              )
                                            }
                                          </select>

                                        </div></td>
                                        </tr>
                                        <tr><th></th><td>&nbsp;</td></tr>
                                        <tr>
                                        <th style={{width: '200px'}}>ผู้ประสานงาน </th>
                                        <td ><div >
                                          <select style={{width: '190px'}} class="selectwidthauto form-control" onChange={(e) => this.setState({ coordinateid: e.target.value })}>
                                            //<option value={this.state.coordinateid} >{this.state.coorname}</option>
                                            {
                                              this.state.coordinate.map(
                                                data =>
                                                <option value={data.user_id} selected={data.user_id == this.state.coordinateid ? 'selected' : ''}>
                                                {data.user_name} {data.user_lastname}
                                              </option>
                                              )
                                            }
                                          </select>

                                        </div></td>
                                        </tr>
                                        <tr><th></th><td>&nbsp;</td></tr>
                                        <tr>
                                        <th style={{width: '200px'}}>ผู้ให้คำปรึกษา </th>
                                        <td ><div >
                                          <select style={{width: '190px'}} class="selectwidthauto form-control" onChange={(e) => this.setState({ partnerid: e.target.value })}>
                                            {
                                              this.state.partner.map(
                                                data =>
                                                <option value={data.id} selected={data.id == this.state.partnerid ? 'selected' : ''}>
                                                {data.name}
                                              </option>
                                              )
                                            }
                                          </select>

                                        </div></td>
                                        </tr>
                                        <tr><th></th><td>&nbsp;</td></tr>
                                        <tr>
                                        <th style={{width: '200px'}}>เส้นทางรับงาน <b style={{color:'red'}}>*</b></th>
                                        <td ><div >
                                          <select style={{width: '190px'}} class="selectwidthauto form-control" onChange={(e) => this.setState({ casechannelid: e.target.value })}>
                                            <option value="0" >-Select-</option>
                                            {
                                              this.state.casechannel.map(
                                                data =>
                                                <option value={data.id} selected={data.id == this.state.casechannelid ? 'selected' : ''}>
                                                {data.name}
                                              </option>
                                              )
                                            }
                                          </select>

                                        </div></td>
                                        </tr>

                                        </table>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="column">

                                                    {this.Step1to2btn()}

                                                    </div>

              </div>
              <div class="tab-pane" role="tabpanel" id="step2">
              <div class="column">

              <div class="card">
                  <div class="card-header" style={{backgroundColor:'#D6FBFF'}}>Step 2 ผู้เอาประกัน</div>
                      <div class="card-body">
                      {this.renderComponentByState()}

                  </div>
              </div>
              <br/>
                      {
                        this.state.memberprofile.map(
                          data =>

                          <div class="card">
                          <div class="card-header" style={{backgroundColor:'#D6FBFF'}}>ข้อมูล ผู้เอาประกัน</div>
                          <div class="card-body">
                          <div class="column">
                          <div class="card">
                          <div class="card-body">
                            {this.MemberorOrganization()}
                        </div>

                        </div>
                        </div>


                      <div class="columnnote">
                      <div class="card" style={{height: '300px'}}>
                      <div class="card-header">เอกสารผู้เอาประกัน {this.Reloadmemberfileflag()}</div>
                      <div class="card-body">
                      <table >
                      {
                        this.state.memberfile.map(
                          data =>
                          <tr>
                          <th style={{width:'200px'}}>{data.filecat.name}</th>
                          <td ><a href={'SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a></td>
                          </tr>

                        )
                      }


                      <br/>
                      <a href={'https://erp.wealththai.net/SecurityBroke/member/uploadfile/'+data.id+'/xxx/CG3CG/Member_Attachment_'+ data.id} target="_blank" class="btn btn-success btn-margin" type="submit">เพิ่มเอกสาร</a>
                    </table>
                    </div>

                    </div>
                    </div>
                      <div class="columnnote">
                      <div class="card" style={{height: '300px'}}>
                      <div class="card-header">ผู้แนะนำ</div>
                      <div class="card-body">
                      <table >
                      {
                      this.state.memberprofile.map(
                        data =>
                        <tr>

                        <th >ชื่อผู้แนะนำ</th>

                        <td >{data.mem_name}</td>
                        </tr>

                      )
                      }


                      <br/>

                      </table>
                      </div>

                      </div>
                      </div>
                        </div>

                        </div>

                        )
                      }

                      <br/>

                      {
                        this.state.memberprofile.map(
                          data =>
                          <div class="card">
                          <div class="card-header" style={{backgroundColor:'#D6FBFF'}}>รถยนต์ <button onClick={this.openaddasset} style={{float: 'right'}} class="btn btn-default"><i  style={{color: 'green'}} class="fa fa-plus"></i></button></div>
                          <div class="card-body">
                          <div class="column">
                          {this.renderComponentAddress()}

                        </div>
                        </div>
                        </div>
                        )
                      }
                      <br/>
                      {
                        this.state.assetdetail.map(
                          data =>
                          <div class="card">
                          <div class="card-header" style={{backgroundColor:'#D6FBFF'}}>ข้อมูล รถยนต์</div>
                          <div class="card-body">
                          <div class="column3">
                          <div class="card">
                          <div class="card-body">

                          <table style={{width: '100%'}}>
                          <tr>
                          <th style={{width: '200px'}}>Asset Name</th>
                          <td >{data.name}</td>

                          </tr>
                          <tr>
                          <th style={{width: '200px'}}>Asset Type</th>
                          <td >{data.asset_type_name}</td>

                          </tr>
                          <tr>
                          <th style={{width: '200px'}}>Sub Type</th>
                          <td >{data.asset_subtype_name}</td>

                          </tr>
                          <tr>
                          <th style={{width: '200px'}}>{data.name_head}</th>
                          <td >{data.ref_name}</td>

                          </tr>
                          <tr>
                          <th style={{width: '200px'}}>Portfolio</th>
                          <td >{data.port_name}</td>

                          </tr>

                          <tr>
                          <th style={{width: '200px'}}>{data.num_head1}</th>
                          <td >{data.ref_number1}</td>

                          </tr>
                          <tr>
                          <th style={{width: '200px'}}>{data.num_head2}</th>
                          <td >{data.ref_number2}</td>

                          </tr>
                          <tr>
                          <th style={{width: '200px'}}>{data.num_head3}</th>
                          <td >{data.ref_number3}</td>

                          </tr>
                          <tr>
                          <th style={{width: '200px'}}>{data.ref_head1}</th>
                          <td >{data.ref_info1}</td>

                          </tr>
                          <tr>
                          <th style={{width: '200px'}}>{data.ref_head2}</th>
                          <td >{data.ref_info2}</td>

                          </tr>
                          <tr>
                          <th style={{width: '200px'}}>{data.ref_head3}</th>
                          <td >{data.ref_info3}</td>

                          </tr>
                          <tr>
                          <th style={{width: '200px'}}>{data.ref_head4}</th>
                          <td >{data.ref_info4}</td>

                          </tr>

                          <tr>
                          <th style={{width: '200px'}}>{data.ref_head5}</th>
                          <td >{data.ref_info5}</td>

                          </tr>
                          <tr>
                          <th style={{width: '200px'}}>{data.ref_head6}</th>
                          <td >{data.ref_info6}</td>

                          </tr>
                          <tr>
                          <th style={{width: '200px'}}>{data.ref_head7}</th>
                          <td >{data.ref_info7}</td>

                          </tr>

                          <br/>
                        </table>
                        </div>
                          </div>
                        </div>
                        <div class="column3">
                        <div class="card">
                        <div class="card-body">

                        <table style={{width: '100%'}}>

                        <tr>
                        <th style={{width: '200px'}}>{data.ref_head8}</th>
                        <td >{data.ref_info8}</td>

                        </tr>
                        <tr>
                        <th style={{width: '200px'}}>{data.ref_head9}</th>
                        <td >{data.ref_info9}</td>

                        </tr>
                        <tr>
                        <th style={{width: '200px'}}>{data.ref_head10}</th>
                        <td >{data.ref_info10}</td>

                        </tr>
                        <tr>
                        <th style={{width: '200px'}}>{data.ref_head11}</th>
                        <td >{data.ref_info11}</td>

                        </tr>
                        <tr>
                        <th style={{width: '200px'}}>{data.ref_head12}</th>
                        <td >{data.ref_info12}</td>

                        </tr>
                        <tr>
                        <th style={{width: '200px'}}>{data.ref_head13}</th>
                        <td >{data.ref_info13}</td>

                        </tr>
                        <tr>
                        <th style={{width: '200px'}}>{data.ref_head14}</th>
                        <td >{data.ref_info14}</td>

                        </tr>
                        <tr>
                        <th style={{width: '200px'}}>{data.ref_head15}</th>
                        <td >{data.ref_info15}</td>

                        </tr>
                        <tr>
                        <th style={{width: '200px'}}>{data.ref_head16}</th>
                        <td >{data.ref_info16}</td>

                        </tr>
                        <tr>
                        <th style={{width: '200px'}}>{data.ref_head17}</th>
                        <td >{data.ref_info18}</td>

                        </tr>


                        <br/>
                      </table>
                      </div>
                        </div>
                      </div>
                        <div class="column3">
                        <div class="card">
                     <div class="card-header">เอกสารถยนต์ {this.Reloadassetfileflag()}</div>
                     <div class="card-body">

                     <table style={{width: '100%'}}>
                     {
                       this.state.assetfile.map(
                         data =>
                     <tr>
                     <th style={{width: '200px'}}>{data.filecat.name}</th>
                     <td ><a href={'SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a></td>

                     </tr>
                   )
                 }

                     <br/>
                     <a href={'https://erp.wealththai.net/SecurityBroke/asset/uploadfile/'+data.port_id+'/'+data.id+'/xxx/CG2CG/Asset_Attachment_'+data.port_id+'_'+ data.id} target="_blank" class="btn btn-success btn-margin" type="submit">เพิ่มเอกสาร</a>
                   </table>
                   </div>
                   </div>
                        </div>
                          </div>
                          </div>

                        )
                      }
                      {this.Step2to3btn()}

                        </div>
                        <div>


                        </div>
              </div>
              <div class="tab-pane" role="tabpanel" id="step3">
                  <div class="column">

                  <div class="card">
                      <div class="card-header" style={{backgroundColor:'#D6FBFF'}}>Step 3 รายละเอียดงาน</div>
                          <div class="card-body">
                          <form onSubmit={this.handleSubmitcase}>
                          <div class={this.state.showdiv}>
                          <div class="column">
                          <div class="card">
                          <div class="card-body">
                          <div class="columntobe2">
                          <table style={{width: '100%'}} >

                          <tr>
                          <th >{this.state.requirevar1}</th>
                          <td ><div style={{width: '190px'}}>
                          <textarea onChange={this.handleChangeRequirevalue1}value={this.state.requirevalue1} class="form-control"></textarea>
                          </div></td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>
                          <th >{this.state.requirevar2}</th>
                          <td ><div style={{width: '190px'}}>
                          <div class="input-group date">

                              <input onChange={this.handleChangeRequirevalue2}value={this.state.requirevalue2} class="form-control" />
                              <div class="input-group-addon">
                                บาท
                              </div>
                          </div>


                          </div></td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>
                          <th >{this.state.requirevar3}</th>
                          <td ><div style={{width: '190px'}}>
                          <label class="checkbox-inline"><input   class="subject-list memtype" type="checkbox" onChange={(e) => this.setState({ requirevalue3: e.target.value })} checked={this.state.requirevalue3 == 'ไม่ทำ' ? 'checked' : ''} value="ไม่ทำ"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ไม่ทำ</label>
                          <label class="checkbox-inline"><input   class="subject-list memtype" type="checkbox" onChange={(e) => this.setState({ requirevalue3: e.target.value })} checked={this.state.requirevalue3 == 'ทำ' ? 'checked' : ''} value="ทำ"/>&nbsp;&nbsp;&nbsp;&nbsp;ทำ</label>
                          </div></td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>
                          {this.Showrequire3()}
                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>
                          <th >{this.state.requirevar4}</th>
                          <td >
                          <div style={{width: '190px'}}>
                          <select style={{width: '190px'}} onChange={(e) => this.setState({ requirevalue4: e.target.value })} class="form-control " >
                          <option value="0">โปรดเลือก</option>
                          <option value="ไม่ทำ" selected={this.state.requirevalue4 == 'ไม่ทำ' ? 'selected' : ''}>ไม่ทำ</option>
                          <option value="ชั้น1" selected={this.state.requirevalue4 == 'ชั้น1' ? 'selected' : ''}>ชั้น 1</option>
                          <option value="ชั้น2+" selected={this.state.requirevalue4 == 'ชั้น2+' ? 'selected' : ''}>ชั้น 2+</option>
                          <option value="ชั้น2" selected={this.state.requirevalue4 == 'ชั้น2' ? 'selected' : ''}>ชั้น 2</option>
                          <option value="ชั้น3+" selected={this.state.requirevalue4 == 'ชั้น3+' ? 'selected' : ''}>ชั้น 3+</option>
                          <option value="ชั้น3" selected={this.state.requirevalue4 == 'ชั้น3' ? 'selected' : ''}>ชั้น 3</option>
                          <option value="อื่นๆ" selected={this.state.requirevalue4 == 'อื่นๆ' ? 'selected' : ''}>อื่น ๆ</option>

                            </select>
                          </div>                       </td>
                          </tr>

                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>
                          <th >{this.state.requirevar5}</th>
                          <td ><div style={{width: '190px',display: 'flex'}}>
                          <select style={{width: '190px'}} onChange={(e) => this.setState({ requirevalue5: e.target.value })} class="form-control " >
                          <option value="ห้าง" selected={this.state.requirevalue5 == 'ห้าง' ? 'selected' : ''}>ห้าง</option>
                          <option value="อู่" selected={this.state.requirevalue5 == 'อู่' ? 'selected' : ''}>อู่</option>


                            </select>
                          </div></td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>

                          {this.Showrequire4()}
                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>
                          <th style={{width: '380px'}}>{this.state.requirevar6}</th>
                          <td ><div style={{width: '190px'}}>

                          <label class="checkbox-inline">  <input class="check" type="checkbox" onChange={(e) => this.setState({ requirevalue6: e.target.value })} checked={this.state.requirevalue6 == 'ไม่ทำ' ? 'checked' : ''} value="ไม่ทำ" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ไม่ทำ</label>
                          <label class="checkbox-inline"><input   class="check" type="checkbox" onChange={(e) => this.setState({ requirevalue6: e.target.value })} checked={this.state.requirevalue6 == 'ทำ' ? 'checked' : ''} value="ทำ"/>&nbsp;&nbsp;&nbsp;&nbsp;ทำ</label>
                          </div></td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>
                          {this.Showrequire6()}


                          </table>
                          </div>
                          </div>
                          </div>
                          </div>

                          <div class="column">
                          <div class="card">
                          <div class="card-body">
                          <div class="columntobe2">
                          <table style={{width: '100%'}}>
                          <tr>

                          <th >{this.state.requirevar10}</th>
                          <td >{this.companyarrayshow()}</td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>
                          <th >{this.state.requirevar11} </th>
                          <td ><div style={{width: '190px'}}>
                          <input onChange={this.handleChangeRequirevalue11}value={this.state.requirevalue11} class="form-control"

                          />
                          </div></td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>
                          <th >{this.state.requirevar12} </th>
                          <td ><div style={{width: '190px'}}>
                          <input onChange={this.handleChangeRequirevalue12}value={this.state.requirevalue12} class="form-control"
                          />
                          </div></td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>
                          <th >{this.state.requirevar13}</th>
                          <td ><div style={{width: '190px'}}>
                          <input onChange={this.handleChangeRequirevalue13}value={this.state.requirevalue13} class="form-control"

                          />
                          </div></td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>
                          <th style={{width: '380px'}}>{this.state.requirevar14} </th>
                          <td ><div style={{width: '190px'}}>

                          <select style={{width: '190px'}} onChange={(e) => this.setState({ requirevalue14: e.target.value })} class="form-control selectwidthauto " >
                          <option value="">โปรดเลือก</option>
                          <option value="ยอดเต็ม" selected={this.state.requirevalue14 == 'ยอดเต็ม' ? 'selected' : ''}>ยอดเต็ม</option>
                          <option value="3เดือน" selected={this.state.requirevalue14 == '3เดือน' ? 'selected' : ''}>3 เดือน </option>
                          <option value="4เดือน" selected={this.state.requirevalue14 == '4เดือน' ? 'selected' : ''}>4 เดือน</option>
                          <option value="6เดือน" selected={this.state.requirevalue14 == '6เดือน' ? 'selected' : ''}>6 เดือน</option>
                          </select>
                          </div></td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>
                          <th >{this.state.requirevar15}</th>
                          <td ><div style={{width: '190px'}}>
                          <textarea onChange={this.handleChangeRequirevalue15}value={this.state.requirevalue15} class="form-control"></textarea>

                          </div></td>
                          </tr>

                          &nbsp;

                          </table>
                          </div>

                          </div>
                          </div>
                          </div>

                          <div class="column">
                          <div class="card">
                          <div class="card-body">
                          <div class="columntobe2">
                          <label style={{marginLeft:'-170px'}} class="checkbox-inline"><input   class="subject-list memtype" type="checkbox" onChange={this.checkcontactdetail}  value="1"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ชื่อเดียวกับผู้เอากรมธรรม์</b></label>

                          <table style={{width: '100%'}}>

                          <tr>
                          <th >{this.state.requirevar16}&nbsp;	&nbsp;	 </th>
                          <td ><div style={{width: '190px'}}>
                          <input onChange={this.handleChangeRequirevalue16}value={this.state.requirevalue16} class="form-control"

                          />
                          </div></td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>
                          <th >{this.state.requirevar17}</th>
                          <td ><div style={{width: '190px'}}>
                          <input onChange={this.handleChangeRequirevalue17}value={this.state.requirevalue17} class="form-control"/>
                          </div></td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>
                          <th style={{width: '380px'}}>{this.state.requirevar18}</th>
                          <td ><div style={{width: '190px'}}>
                          <input onChange={this.handleChangeRequirevalue18}value={this.state.requirevalue18} class="form-control"

                          />
                          </div></td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>
                          <th >{this.state.requirevar19}</th>
                          <td ><div style={{width: '190px'}}>
                          <textarea onChange={this.handleChangeRequirevalue19}value={this.state.requirevalue19} class="form-control"
                          >
                                                    </textarea>
                          </div></td>
                          </tr>
                          <tr><th></th><td>&nbsp;</td></tr>
                          <tr>
                          <th >{this.state.requirevar20}</th>
                          <td ><div style={{width: '190px'}}>
                          <textarea onChange={this.handleChangeRequirevalue20}value={this.state.requirevalue20} class="form-control"></textarea>
                          </div></td>
                          </tr>



                          </table>
                          </div>
                          </div>
                          </div>
                          </div>
                          </div>
                          <div class={this.state.hidediv}>


                          <div class="column">
                          <div class="card">
                          <div class="card-header" style={{backgroundColor:'#81F7BE'}}>รายละเอียดลูกค้า</div>
                          <div class="card-body">

                          {
                            this.state.memberprofile.map(
                              data =>
                              <div>
                              <div class="column2">
                              <div class="card" style={{height: '300px'}}>
                              <div class="card-header" >รายละเอียดลูกค้า</div>
                              <div class="card-body">
                              <table style={{width: '100%'}}>
                                                    <tr>
                                                    <th >ชื่อ</th>
                                                    <td ><div style={{width: '190px'}}>
                                                      {data.name} {data.lname}

                                                    </div></td>
                                                    </tr>
                                                    <tr><th></th><td>&nbsp;</td></tr>
                                                    <tr>
                                                    <th >ที่อยู่</th>
                                                    <td >
                                                      เลขที่ {data.add2} ซอย {data.add2_alley} ถนน{data.add2_road} แขวง{data.add2_subdistrict} เขต {data.add2_district} จังหวัด {data.add2_city} รหัสไปรษณีย์ {data.add2_postcode}
                                                  </td>
                                                    </tr>
                                                    <tr><th></th><td>&nbsp;</td></tr>
                                                    <tr>
                                                    <th >เบอร์โทร</th>
                                                    <td >
                                                      {data.mobile}
                                                  </td>
                                                    </tr>
                                                    <tr><th></th><td>&nbsp;</td></tr>
                                                    <tr>
                                                    <th >อีเมล</th>
                                                    <td >
                                                      {data.email}
                                                  </td>
                                                    </tr>
                                                    <tr><th></th><td>&nbsp;</td></tr>
                                                    <tr>
                                                    <th >แฟกซ์</th>
                                                    <td >
                                                      {data.add2fax}
                                                  </td>
                                                    </tr>
                                                    </table>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <div class="columnnote">
                                                    <div class="card" style={{height: '300px'}}>
                                                    <div class="card-header">เอกสารผู้เอาประกัน {this.Reloadmemberfileflag()}</div>
                                                    <div class="card-body">
                                                    <table >
                                                    {
                                                      this.state.memberfile.map(
                                                        data =>
                                                        <tr>
                                                        <th style={{width:'200px'}}>{data.filecat.name}</th>
                                                        <td ><a href={'SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a></td>
                                                        </tr>

                                                      )
                                                    }


                                                    <br/>
                                                    <a href={'https://erp.wealththai.net/SecurityBroke/member/uploadfile/'+data.id+'/xxx/CG3CG/Member_Attachment_'+ data.id} target="_blank" class="btn btn-success btn-margin" type="submit">เพิ่มเอกสาร</a>
                                                  </table>
                                                  </div>

                                                  </div>
                                                  </div>
                                                    </div>

                            )
                            }


                          </div>
                          </div>
                          </div>
                          <div class="column">

                          {
                            this.state.assetdetail.map(
                              data =>
                              <div class="card">
                              <div class="card-header"style={{backgroundColor:'#81F7BE'}}>ข้อมูลรถยนต์</div>
                              <div class="card-body">
                              <div class="column3">
                              <div class="card">
                              <div class="card-body">

                              <table style={{width: '100%'}}>
                              <tr>
                              <th style={{width: '200px'}}>Asset Name</th>
                              <td >{data.name}</td>

                              </tr>
                              <tr>
                              <th style={{width: '200px'}}>Asset Type</th>
                              <td >{data.asset_type_name}</td>

                              </tr>
                              <tr>
                              <th style={{width: '200px'}}>Sub Type</th>
                              <td >{data.asset_subtype_name}</td>

                              </tr>
                              <tr>
                              <th style={{width: '200px'}}>{data.name_head}</th>
                              <td >{data.ref_name}</td>

                              </tr>
                              <tr>
                              <th style={{width: '200px'}}>Portfolio</th>
                              <td >{data.port_name}</td>

                              </tr>

                              <tr>
                              <th style={{width: '200px'}}>{data.num_head1}</th>
                              <td >{data.ref_number1}</td>

                              </tr>
                              <tr>
                              <th style={{width: '200px'}}>{data.num_head2}</th>
                              <td >{data.ref_number2}</td>

                              </tr>
                              <tr>
                              <th style={{width: '200px'}}>{data.num_head3}</th>
                              <td >{data.ref_number3}</td>

                              </tr>
                              <tr>
                              <th style={{width: '200px'}}>{data.ref_head1}</th>
                              <td >{data.ref_info1}</td>

                              </tr>
                              <tr>
                              <th style={{width: '200px'}}>{data.ref_head2}</th>
                              <td >{data.ref_info2}</td>

                              </tr>
                              <tr>
                              <th style={{width: '200px'}}>{data.ref_head3}</th>
                              <td >{data.ref_info3}</td>

                              </tr>
                              <tr>
                              <th style={{width: '200px'}}>{data.ref_head4}</th>
                              <td >{data.ref_info4}</td>

                              </tr>

                              <tr>
                              <th style={{width: '200px'}}>{data.ref_head5}</th>
                              <td >{data.ref_info5}</td>

                              </tr>
                              <tr>
                              <th style={{width: '200px'}}>{data.ref_head6}</th>
                              <td >{data.ref_info6}</td>

                              </tr>
                              <tr>
                              <th style={{width: '200px'}}>{data.ref_head7}</th>
                              <td >{data.ref_info7}</td>

                              </tr>

                              <br/>
                            </table>
                            </div>
                              </div>
                            </div>
                            <div class="column3">
                            <div class="card">
                            <div class="card-body">

                            <table style={{width: '100%'}}>

                            <tr>
                            <th style={{width: '200px'}}>{data.ref_head8}</th>
                            <td >{data.ref_info8}</td>

                            </tr>
                            <tr>
                            <th style={{width: '200px'}}>{data.ref_head9}</th>
                            <td >{data.ref_info9}</td>

                            </tr>
                            <tr>
                            <th style={{width: '200px'}}>{data.ref_head10}</th>
                            <td >{data.ref_info10}</td>

                            </tr>
                            <tr>
                            <th style={{width: '200px'}}>{data.ref_head11}</th>
                            <td >{data.ref_info11}</td>

                            </tr>
                            <tr>
                            <th style={{width: '200px'}}>{data.ref_head12}</th>
                            <td >{data.ref_info12}</td>

                            </tr>
                            <tr>
                            <th style={{width: '200px'}}>{data.ref_head13}</th>
                            <td >{data.ref_info13}</td>

                            </tr>
                            <tr>
                            <th style={{width: '200px'}}>{data.ref_head14}</th>
                            <td >{data.ref_info14}</td>

                            </tr>
                            <tr>
                            <th style={{width: '200px'}}>{data.ref_head15}</th>
                            <td >{data.ref_info15}</td>

                            </tr>
                            <tr>
                            <th style={{width: '200px'}}>{data.ref_head16}</th>
                            <td >{data.ref_info16}</td>

                            </tr>
                            <tr>
                            <th style={{width: '200px'}}>{data.ref_head17}</th>
                            <td >{data.ref_info18}</td>

                            </tr>


                            <br/>
                          </table>
                          </div>
                            </div>
                          </div>
                            <div class="column3">
                            <div class="card">
                         <div class="card-header">เอกสารถยนต์ {this.Reloadassetfileflag()}</div>
                         <div class="card-body">

                         <table style={{width: '100%'}}>
                         {
                           this.state.assetfile.map(
                             data =>
                         <tr>
                         <th style={{width: '200px'}}>File</th>
                         <td ><a href={'SecurityBroke/showfile/' + data.id} target="_blank">{data.file_public_name}</a></td>

                         </tr>
                       )
                     }

                         <br/>
                         <a href={'https://erp.wealththai.net/SecurityBroke/asset/uploadfile/'+data.port_id+'/'+data.id+'/xxx/CG2CG/Asset_Attachment_'+data.port_id+'_'+ data.id} target="_blank" class="btn btn-success btn-margin" type="submit">เพิ่มเอกสาร</a>
                       </table>
                       </div>
                       </div>
                            </div>
                              </div>
                              </div>

                            )
                          }

                          </div>

                          </div>
                          <div class="column3" >
                            {this.Checkflag()}
                          </div>

                          </form>

                      </div>
                  </div>
                  <br/>
                            </div>



              </div>

              </div>
              </div>
              </div>
  }
    render() {

      let options = this.state.member.map(function (member) {
        return { value: member.id, label: member.name +' '+ member.lname };
      })
      let memcar = this.state.membercar.map(function (asset) {
        return { value: asset.id, label: asset.name };
      })
      var i = 3;
        const { assurance } = this.state


        return assurance.length ? this.showdetail() : (
          <span style={{textAlign:'center'}}>กำลังโหลดข้อมูล กรุณารอสักครู่..</span>
        )
    }
}

if (document.getElementById('insuranceedit')) {
    ReactDOM.render(<Insuranceedit />, document.getElementById('insuranceedit'));
}

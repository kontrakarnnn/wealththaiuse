import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
export default class Example extends Component {
  constructor(){
    super();
    //console.log(super());
    this.state = {
      news:[],
      name:'',
      country_code:'',
    };
    this.handleChangeCountrycode = this.handleChangeCountrycode.bind(this);
    this.handleChangeName = this.handleChangeName.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);

  }
  handleChangeName(e){
    console.log(e.target.value);
    this.setState({
      name:e.target.value,
    })
  }

  handleChangeCountrycode(e){
    console.log(e.target.value);
    this.setState({
      country_code:e.target.value,
    })
  }

  handleSubmit(e){
    e.preventDefault();
    axios.post('/admin/addCountry',{
      name:this.state.name,
      country_code:this.state.country_code
    }).then(res=>{

      console.log(res.data);
      this.setState({
        news:res.data
      })
    });
    console.log(e.target.value);
    this.setState({
      country_code:e.target.value,
    })
  }

  componentDidMount(){
    axios.get('/country').then(response=>{
      this.setState({news:response.data});
        console.log('news');
    }).catch(errors=>{
      console.log(errors);
    })
  }
    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">Example Component</div>

                            <div className="card-body">
                            <form onSubmit={this.handleSubmit}>
                            Country Code:<input
                            onChange={this.handleChangeCountrycode}
                            value={this.state.country_code}
                            />
                            name:<textarea
                            onChange={this.handleChangeName}
                            value={this.state.name}></textarea>
                            <button type="submit">Save</button>
                            </form>
                            {
                              this.state.news.map(
                                data =>
                                <div>
                                <h4>
                                {data.name}
                                </h4>
                                </div>
                              )
                            }
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}

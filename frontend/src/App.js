import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';
import 'bootstrap/dist/css/bootstrap.css';

import SurveyList from "./components/stage1/SurveyList";
import DisplayResult from "./components/stage1/DisplayResult";


class App extends Component {
  constructor(props){
    super(props);
    this.state = {
      selectedSurvey: null,
    };
  }

  updateSelectedSurvey = (survey) => {
    this.setState({ selectedSurvey: survey });
  };

  render() {
    let displayResult = null;
    if (this.state.selectedSurvey)
      displayResult = <DisplayResult selectedSurvey={ this.state.selectedSurvey }/>;
    return (
      <div className="App">
        <header className="App-header">
          <img src={logo} className="App-logo" alt="logo" />
          <h1 className="App-title">Welcome to React</h1>
        </header>
        <p className="App-intro">
          To get started, edit <code>src/App.js</code> and save to reload.
        </p>
        <div className="container">
          <SurveyList updateSelectedSurvey={ this.updateSelectedSurvey }/>
          { displayResult }
        </div>
      </div>
    );
  }
}

export default App;

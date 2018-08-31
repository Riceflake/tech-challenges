import React, { Component } from 'react';

class SurveyList extends Component {
  constructor() {
    super();
    this.state = {
      surveys: [],
    };
  }

  componentDidMount() {
    this.getSurveys();
  }

  handleClick(code) {
    console.log(`${window.location.href}/api/${code}.json`);
    let codePath = `${window.location.href}/api/${code}.json`;
    fetch(codePath)
      .then((response) => { return response.json() })
      .then((surveyData) => {
        this.props.updateSelectedSurvey(surveyData);
      })
  };

  getSurveys() {
    let url = `${window.location.href}/api/list.json`;
    fetch(url)
      .then((response) => { return response.json() })
      .then((data) => {
        let surveys = data.map((survey, i) => {
          return(
            <tbody key={i}>
              <tr onClick={ () => this.handleClick(survey.code) }>
                <td>{ survey.name }</td>
                <td>{ survey.code }</td>
              </tr>
            </tbody>
          )
        });
        this.setState({ surveys: surveys });
      })
  }

  render() {
    return (
      <table className="table table-bordered table-hover">
        <thead>
        <tr>
          <th>Name</th>
          <th>Code</th>
        </tr>
        </thead>
        { this.state.surveys }
      </table>
    );
  }
}

export default SurveyList;

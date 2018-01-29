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

  getSurveys() {
    let url = 'http://localhost:3000/api/list.json';
    fetch(url)
      .then((response) => { return response.json()})
      .then((data) => {
        let surveys = data.map((survey, i) => {
          return(
            <tbody key={i}>
            <tr>
              <td>{ survey.name }</td>
              <td>{ survey.code }</td>
            </tr>
            </tbody>
          )
        })
        this.setState({ surveys: surveys });
      })
  }

  render() {
    return (
      <div className="container">
        <table className="table table-bordered">
          <thead>
          <tr>
            <th>Name</th>
            <th>Code</th>
          </tr>
          </thead>
          { this.state.surveys }
        </table>
      </div>
    );
  }
}

export default SurveyList;

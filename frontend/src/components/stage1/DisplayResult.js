import React, { Component } from 'react';

class DisplayResult extends Component {
  render() {
    return (
      this.props.selectedSurvey.map((survey, i) => {
        return (
          <div className="card" key={i}>
            <div className="card-header">
              Survey name : { survey.label }
            </div>
            <div className="card-block">
              <p className="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
        )
      })
    )
  }
}

export default DisplayResult;

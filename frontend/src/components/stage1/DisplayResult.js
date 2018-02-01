import React, { Component } from 'react';
import { Bar } from 'react-chartjs-2';
import moment from 'moment';


class DisplayResult extends Component {
  constructor() {
    super();
    this.state = {
      backgroundColorArray:[
        "rgba(231, 76, 60, 0.5)",
        "rgba(52, 152, 219, 0.5)",
        "rgba(46, 204, 113, 0.5)",
        "rgba(26, 188, 156, 0.5)",
        "rgba(241, 196, 15, 0.5)",
        "rgba(230, 126, 34, 0.5)",
        "rgba(155, 89, 182, 0.5)",
      ],
      backgroundHoverColorArray: [
        "rgba(192, 57, 43, 0.5)",
        "rgba(41, 128, 185, 0.5)",
        "rgba(39, 174, 96, 0.5)",
        "rgba(26, 188, 156, 0.5)",
        "rgba(243, 156, 18, 0.5)",
        "rgba(211, 84, 0, 0.5)",
        "rgba(142, 68, 173, 0.5)"
      ]
    }
  }

  generateColorArray(colorArray, size) {
    let colorArrayResult = [];
    for (let i = 0; i < size; i++)
    {
      colorArrayResult.push(colorArray[i % colorArray.length])
    }
    return colorArrayResult;
  }

  createBarOptions(survey) {
    return {
      responsive: true,
      legend: { display: false },
      title: {
        display: true,
          text: survey.label
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            stepSize: 1,
          }
        }]
      }
    }
  }

  createBarDataChart(survey) {
    return {
      labels: Object.keys(survey.result),
      datasets: [{
        borderWidth: 1,
        backgroundColor: this.generateColorArray(this.state.backgroundColorArray, Object.keys(survey.result).length),
        hoverBackgroundColor: this.generateColorArray(this.state.backgroundHoverColorArray, Object.keys(survey.result).length),
        data: Object.values(survey.result),
      }],
    }
  }

  createNumericCard(survey, i) {
    return (
      <div className="card my-5" key={i}>
        <div className="card-header">
          <h4>{ survey.label }</h4>
        </div>
        <div className="card-block">
          <p className="card-text py-3">{ survey.result }</p>
        </div>
      </div>
    )
  }

  createDateCard(survey) {
    return survey.result.map((date, i) => {
      return (
        <li key={i} className="list-group-item">{ moment(date).format("LLL") }</li>
      )
    });
  }

  render() {
    return (
      this.props.selectedSurvey.map((survey, i) => {
        if (survey.type === "qcm") {
          return (
            <Bar
              key={i}
              data={ this.createBarDataChart(survey) }
              options={ this.createBarOptions(survey) }
            />
          )
        }
        else if (survey.type === "numeric") {
          return this.createNumericCard(survey, i);
        }
        else {
          return (
            <div className="card my-5" key={i}>
              <div className="card-header">
                <h4>{ survey.label }</h4>
              </div>
              <div className="card-block">
              <ul className="list-group">
                { this.createDateCard(survey) }
              </ul>
              </div>
            </div>
          )
        }
      })
    )
  }
}

export default DisplayResult;

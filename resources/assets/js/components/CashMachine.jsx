
import React from 'react'
import { connect } from 'react-redux'
import withdraw from '../actions/cashMachine'

export class CashMachine extends React.Component {
  constructor(props, context) {
    super(props, context);
    this.state = {
      notes: null,
      id: 1
    };
    this.handleChange = this.handleChange.bind(this);
    this.onSubmit = this.onSubmit.bind(this);
  }

  handleChange (e) {
    if (!_.isUndefined (e)) {
      this.setState({ [e.target.name]: e.target.value });
    }
  }

  onSubmit (e) {
    e.preventDefault();
    this.props.withdraw(this.state);
  }

  render() {
    const noteItems = this.props.cashMachine.notes.map((val) =>
      <li>${val.toFixed(2)}</li>
    );
    return (
      <div class="text-center col-sm-2">
        <h1>Cash Machine</h1>
        <form onSubmit={this.onSubmit}>
          <div class="mt-1 mb-2 form-group">
            <label>Cash</label>
            <div class="text-danger">{this.props.cashMachine.errors}</div>
            <input
              type="text"
              name='notes'
              onChange={this.handleChange}
              value={this.state.value}
              class="form-control"
            />
          </div>
          <input type="submit" value="Withdraw" class="btn btn-primary"/>
          <div class="mt-2">{noteItems}</div>
        </form>
      </div>
    );
  }
}


const mapStateToProps = state => {
  const stateToprops = {
    cashMachine: state.cashMachine
  };
  return stateToprops;
};

const mapDispatchToProps = (dispatch) => {
  const dispatchProps = {
    withdraw: (state) => {
      dispatch(withdraw(state));
    }
  };
  return dispatchProps;
};

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(CashMachine)


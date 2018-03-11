
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'

import React from 'react'
import ReactDOM from 'react-dom'
import { createStore, combineReducers, applyMiddleware, compose } from 'redux'
import { Provider } from 'react-redux'
// import { Router, Route, IndexRoute, browserHistory } from 'react-router'
import { routerReducer } from 'react-router-redux'
import thunk from 'redux-thunk'
import * as reducers from './reducers'
import CashMachine from './components/CashMachine'

const reducer = combineReducers(
  Object.assign({}, reducers, {
      routing: routerReducer,
  }),
);

// const initialState = {
//     application: {
//         token: randomToken(),
//         createdAt: dt,
//     },
// };

const store = createStore(
  reducer,
  {},
  // initialState,
  compose(
    applyMiddleware(
      thunk,
    ),
  ),
);

ReactDOM.render(
  <Provider store={store}>
    <CashMachine />
  </Provider>,
  document.getElementById('app')
);


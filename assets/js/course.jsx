import {Course} from './components/Course';
import ReactDOM from 'react-dom';
import * as React from 'react';

const element = document.getElementById('course');
const courseId = element.getAttribute('data-id');

ReactDOM.render(<Course id={courseId}/>, element);

import * as React from 'react';
import {CourseService} from '../services/CourseService';

export class Course extends React.Component {

    constructor(props) {
        super(props);

        CourseService.get(props.id).then((data) => {
            console.log(data);
        });
    }

    render() {
        return <h1>Course Component</h1>;
    }

}

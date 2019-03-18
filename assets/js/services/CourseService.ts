import {ApiService} from './ApiService';

class Course extends ApiService {

    public get(id: number) {
        return this.call(`/api/course/${id}`);
    }

}

export const CourseService = new Course();

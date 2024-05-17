import ModelService from "@/services/ModelService";

export default class JobService extends ModelService {

    constructor() {
        super();
        this.url = '/jobs';
    }
}

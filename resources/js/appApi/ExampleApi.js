import BaseDataApi from './BaseDataApi';
class ExampleApi extends BaseDataApi {
    constructor() {
        super({name: 'examples'});
        // this.url.search = () => `${this.apiUrl}/examples/search`
    }
}
export default ExampleApi;
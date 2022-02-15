import MenuApi from './MenuApi'
import SubjectApi from './SubjectApi'
import CategoryApi from './CategoryApi'
import SubcategoryApi from './SubcategoryApi'
import ExampleApi from './ExampleApi'
import DialogApi from './DialogApi'




export const $api = {
  menuApi: new MenuApi(),
  subject: new SubjectApi(),
  category: new CategoryApi(),
  subcategory: new SubcategoryApi(),
  example: new ExampleApi(),
  dialog: new DialogApi(),


  }
  
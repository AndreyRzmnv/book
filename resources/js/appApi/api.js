import MenuApi from './MenuApi'
import SubjectApi from './SubjectApi'
import CategoryApi from './CategoryApi'
import SubcategoryApi from './SubcategoryApi'




export const $api = {
  menuApi: new MenuApi(),
  subject: new SubjectApi(),
  category: new CategoryApi(),
  subcategory: new SubcategoryApi(),


  }
  
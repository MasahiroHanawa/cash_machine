import { NOTES, NOTE_VALIDATION } from '../constants';

const initialState = {
  notes: [],
  errors: null,
  status: null
};

export default function withdraw(state = initialState, action) {
  switch (action.type) {
    case NOTES:
    {
      return {
        notes: action.data.notes,
        errors: null
      };
    }
    case NOTE_VALIDATION:
    {
      return {
        notes: [],
        errors: action.data.errors
      };
    }
    default:
    {
      return {
        notes: [],
        errors: null
      };
    }
  }
}

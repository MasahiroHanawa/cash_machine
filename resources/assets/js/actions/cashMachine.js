import { NOTES, NOTE_UNAVAILABLE, NOTE_VALIDATION } from '../constants';
import apiClient from '../utils/api';

export default function withdraw(states) {
  return (dispatch) => {
    apiClient().post(`/api/notes/${states.id}`, {
      notes: states.notes
    })
    .then((apiResponse) => {
      dispatch({
        type: NOTES,
        data: apiResponse.data
      });
    })
    .catch((apiResponse) => {
      dispatch({
        type: NOTE_VALIDATION,
        data: apiResponse.response.data
      });
    });
  };
}
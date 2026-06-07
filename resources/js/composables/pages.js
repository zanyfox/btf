import { ref } from 'vue'
import { useRouter } from 'vue-router'
import Swal from 'sweetalert2'
import axios from 'axios'

export default function usePages() {

  const pages = ref([])
  const page = ref({})
  const errors = ref({})

  const router = useRouter()

  const getPages = () => {
    fetch('/api/backend/pages').then((response) => response.json()).then((data) => {
      pages.value = data.pages
    }).catch((error) => {
      console.error('Error fetching pages:', error)
    })
  }

  const getPage = (id) => {
    fetch(`/api/backend/pages/${id}`).then((response) => response.json()).then((data) => {
      page.value = data.page
    }).catch((error) => {
      console.error('Error fetching page:', error)
    })
  }

  const storePage = (data) => {
    try {
      fetch('/api/backend/pages', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(data)
      }).then( res => res.json()).then(data => {
        if(data.status == 'success') {
          router.push({name: 'BackendPageIndex'})
        }
      }).catch(err => console.error(err.message))

    } catch(error) {
      if(error.response.status == 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  const updatePage = (id) => {
    try {
      fetch('/api/backend/pages/' + id, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(page.value)
      }).then( res => res.json()).then(data => {
        if(data.status == 'success') {
          router.push({name: 'BackendPageIndex'})
        }
      }).catch(err => console.error(err.message))

    } catch(error) {
      if(error.response.status == 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  const destroyPage = (id) => {

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/api/backend/pages/${id}`)
                .then((response) => {
                    //updateAppointmentStatusCount(id);
                    //appointments.value.data = appointments.value.data.filter(appointment => appointment.id !== id)
                    getPages()
                    router.push({name: 'BackendPageIndex'})
                    Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )
                });
        }
    })

  }

  return {
    pages,
    page,
    errors,
    getPages,
    getPage,
    storePage,
    updatePage,
    destroyPage
  }

}

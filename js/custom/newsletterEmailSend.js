const sendPostUrlKlaviyo = async (userEmail) => {
	const formData = new FormData()
	const postUrl = location.href
	formData.append('userEmail', userEmail)
	formData.append('postUrl', postUrl)
	formData.append('action', 'klaviyo_email_send')

	try {
	  const request = await fetch(theme.ajaxUrl, {
		method: 'POST',
		body: formData,
	  })

	  const response = await request.json()

	  if(response) {
		if(response.success) console.log('Mail from the newsletter form has been successfully sent!');
	  }
	}

	catch(e) {
	  console.log(e);
	}

  }

  window.addEventListener("klaviyoForms", function(e) {
	if (e.detail.type == 'submit' && theme.formID == e.detail.formId) {
	  const userEmail = e.detail.metaData.$email
	  sendPostUrlKlaviyo(userEmail)
	}
  });

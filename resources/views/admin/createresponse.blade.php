<div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Respond for this Ticket</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    <h3 class="text-secondary">{{$ticket->subject}}</h3>
<div class="border border-2 rounded-2 bg-secondary p-1">   
    <p class="text-white">{{$ticket->desc}}</p>
</div>
      <label for="response">Response Text</label>
      <textarea name="response" id="response"class="response form-control"></textarea>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="storeresponse btn btn-primary" name="submit" data-id="{{$ticket->id}}">Send</button>
  </div>
@extends('layouts.app')
@section('content')

    <div class="content__mtStatus px-2">
        <!-- Modal -->
        <div class="modal fade" id="fileInFolderCopyBtn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold text-black-50 " id="exampleModalLabel">Copy <i class="fa fa-copy text-black-50"></i></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center align-items-center gap-5">
                            <button id="internalCopyBtn" style="cursor:pointer; background-color: #E8F0FE;" class="btn rounded-2 fw-bold">Copy Internal Folder</button>
                            <button id="externalCopyBtn" style="cursor:pointer; background-color: #E8F0FE;" class="btn rounded-2 fw-bold">Copy External Folder</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="py-1 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #F0F0F0">
           <div class="d-flex align-items-center gap-2">
               <a href="{{ route('myDrive.index') }}" class="mb-0 d-flex align-items-center gap-3 py-2  px-3 rounded text-decoration-none"
                  style="cursor:pointer; background-color: #E8F0FE;">
                   <h5 class="mb-0 text-primary fw-bold">
                       My Drive
                   </h5>
               </a>
               <div>
                   <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>
               </div>
               <h5 class="mb-0 d-flex align-items-center gap-3 py-2  px-3 rounded"
                   style="background-color: #E8F0FE; cursor:pointer;"
                   data-bs-toggle="dropdown"
                   aria-expanded="false">
                   {{ $getFolder->name }}
                   <i class="fa fa-caret-down"></i>
               </h5>
               <x-control folder="true" :folderId="$getFolder->id"  :fileId="$getFolder" external="false"/>
           </div>

        </div>


        <div class="myDrive__container py-3 d-flex align-items-center gap-3 flex-wrap">
            @forelse($getFolder->files as $drive)
                <div
                    class="myDrive__item__container border-2 border border-opacity-25 border-secondary"
                >
                    <div style="height: 80%; border-bottom: 1px solid #F0F0F0; background-color: #E5E7E8" class="overflow-hidden text-center">
                        @if($drive->extension === "jpg" || $drive->extension === "png" || $drive->extension === "jpeg" )
                            <img src="{{ asset(\Illuminate\Support\Facades\Storage::url($drive->new_name)) }}" style="height:100%" alt="">
                        @endif
                        <div class="w-100 h-100 d-flex justify-content-center align-items-center">

                          <x-file :drive="$drive" size="item__extension__icon"/>

                        </div>
                    </div>
                    <div
                        class="bg-white px-3 py-2 item__container"
                        style="height: 20%"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <div class="d-flex gap-2  align-items-center h6 mb-0">

                            <x-file :drive="$drive" size="sm__extension__icon" />

                            <div>{{ Str::limit($drive->original_name, 10, "...".$drive->extension) }}</div>
                        </div>
                    </div>
                    <x-control folder="false" :folderId="$getFolder->id" :fileId="$drive->id" external="false"/>
                </div>
            @empty
                <div class="d-flex justify-content-center align-items-center empty__container">
                    <h4 class="mb-0 fw-bold text-black-50">Empty File . . . . .</h4>
                </div>
            @endforelse
        </div>

    </div>

@endsection

@push('script')
    <script>
        let newFileFolder = document.getElementById('newFileFolder');
        let uploadFormFolder = document.getElementById('uploadFormFolder');
        let uploadFileFolder = document.getElementById('uploadFileFolder');

        newFileFolder.addEventListener('click', () => {
            uploadFileFolder.click();
        });
        uploadFileFolder.addEventListener('change', () => {
            uploadFormFolder.submit();
        })


        //Copy File Inside Folder Status
        let internalCopyBtn = document.getElementById('internalCopyBtn');
        let externalCopyBtn = document.getElementById('externalCopyBtn');
        let internalCopy = document.getElementById('internalCopy');
        let externalCopy = document.getElementById('externalCopy');

        internalCopyBtn.addEventListener('click', () => {
            internalCopy.submit();
        });
        externalCopyBtn.addEventListener('click', () => {
            externalCopy.click();
        });

    </script>
@endpush
